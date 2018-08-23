<?php

namespace Controller;

/**
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Router\Request;
use \Entity\Post;
use \Entity\Comment;
use \Entity\User;
use \Blog\Helpers\SessionHelper;

class FrontendController extends Controller

{

    /**
     *
     * @param Request $request
     */
    public function index()
    {
        $this->page->addVar("titre", APP_NOM);

        $posts = $this->getManager('Post')->getAll();

        $this->page->addVar("posts", $posts);

        $this->page->getPage();
    }

    /**
     *
     * @param Request $request
     */
    public function show(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->commenter($request);
        }

        $this->page->addVar("titre", "Article n° ".$request->getData('id'));

        $post = $this->getManager('Post')->getUnique($request->getData('id'));

        $this->page->addVar("post", $post);

        $comments = $this->getManager('Comment')->getList(
            $request->getData('id'),
            1
        );

        $this->page->addVar("comments", $comments);

        $this->page->getPage();
    }

    /**
     *
     * @param Request $request
     */
    public function commenter(Request $request)
    {
        $comment = new Comment(
            [
            'idPost' => $request->getData('id'),
            'idUser' => $this->session->session('idUser'),
            'contenu' => $request->postData('contenu'),
            ]
        );

        if ($comment->isValid()) {
            $this->getManager('Comment')->save($comment);

            $this->session->setFlash(
                "Votre commentaire a été envoyé. Il ne s'affichera qu'aprés "
                ."validation de l'administrateur."
            );

            $this->reponse->redirect(
                '/article-'.$request->getData('id').'.html'
            );
        }
        if (!$comment->isValid()) {
            $this->session->setFlash(
                "Votre commentaire n'a été ajouté",
                "danger"
            );
        }
    }

    /**
     *
     * @param Request $request
     */
    public function connexion(Request $request)
    {
        $this->page->addVar("titre", "Connexion");

        if ($request->postData('email') && $request->postData('mdp')) {
            $email = $request->postData('email');

            $mdp = $request->postData('mdp');

            $user = $this->getManager('User')->login($email, $mdp);

            if ($this->session->isAuthenticated() && $user) {
                $this->session->setSession('idUser', $user->getId());
                $this->session->setSession('nom', $user->getNom());
                $this->session->setSession('prenom', $user->getPrenom());
                $this->session->setSession('role', $user->getRole());

                if ($user->getRole() == 1) {
                    $this->reponse->redirect('/admin/');
                }
                if ($user->getRole() != 1) {
                    $this->reponse->redirect("/");
                }
            } else {
                $this->session->setFlash(
                    "Votre identifiant ou votre mot de passe est incorrect",
                    "danger"
                );
            }
        }
        $this->page->getPage();
    }
}
