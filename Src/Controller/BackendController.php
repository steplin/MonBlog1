<?php

namespace Controller;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Router\Request;
use \Entity\User;
use \Entity\Post;
use \Blog\Helpers\SessionHelper;

class BackendController extends Controller
{

    /**
     *
     * @param Request $request
     */
    public function index()
    {
        $this->page->addVar("titre", "Espace administration");

        if ($this->getManager('Comment')->notValid()) {
            $this->reponse->redirect('/admin/newcomment.html');
        }

        $posts = $this->getManager('Post')->getAll();

        $this->page->addVar("posts", $posts);

        $this->page->getPage();
    }

    /**
     *
     * @param Request $request
     */
    public function newcomment()
    {
        $this->page->addVar("titre", "Commentaires non publiés");
        $posts = $this->getManager('Comment')->listeComments(0);
        $this->page->addVar("posts", $posts);
        $this->page->getPage();
    }

    /**
     *
     * @param Request $request
     */
    public function show(Request $request)
    {
        $this->page->addVar("titre", "Article n° ".$request->getData('id'));

        $post = $this->getManager('Post')->getUnique($request->getData('id'));

        $this->page->addVar("post", $post);

        $commentsValid = $this->getManager('Comment')->getList(
            $request->getData('id'),
            1
        );

        $this->page->addVar("commentsValid", $commentsValid);

        $commentsNotValid = $this->getManager('Comment')->getList(
            $request->getData('id'),
            0
        );

        $this->page->addVar("commentsNotValid", $commentsNotValid);

        $this->page->getPage();
    }

    /**
     *
     * @param Request $request
     */
    public function publier(Request $request)
    {
        if ($this->session->isAuthenticated()) {
            $this->getManager('Comment')->publier($request->getData('id'));

            $this->session->setFlash("Le commentaire a été publié");

            $this->reponse->redirect(
                '/admin/article-'.$request->getData('idPost').'.html'
            );
        }
    }

    /**
     *
     * @param Request $request
     */
    public function deleteComment(Request $request)
    {
        if ($this->session->isAuthenticated()) {
            $this->getManager('Comment')->delete($request->getData('id'));

            $this->session->setFlash("Le commentaire a été supprimé");

            $this->reponse->redirect(
                '/admin/article-'.$request->getData('idPost').'.html'
            );
        }
    }

    /**
     *
     * @param Request $request
     */

    public function deletePost(Request $request)
    {
        if ($this->session->isAuthenticated()) {
            $this->getManager('Post')->delete($request->getData('id'));

            $this->getManager('Comment')->deleteAllComments(
                $request->getData('id')
            );

            $this->session->setFlash("L'article a été supprimé");

            $this->reponse->redirect('/admin/');
        }
    }

    /**
     *
     * @param Request $request
     */
    public function addArticle(Request $request)
    {
        if ($request->method() == 'POST') {
            $post = new Post(
                [
                'idUser' => $this->session->session('idUser'),
                'titre' => $request->postData('titre'),
                'contenu' => $request->postData('contenu'),
                ]
            );
            if ($post->isValid()) {
                $this->getManager('Post')->save($post);

                $this->session->setFlash("L'article a été ajouté");

                $this->reponse->redirect(
                    '/admin/article-'.$post->getId().'.html'
                );
            }
            if (!$post->isValid()) {
                $this->session->setFlash(
                    "L'article n'a pas été ajouté",
                    "danger"
                );
            }
        }
        $this->page->addVar("titre", "Ajouter un article");
        $this->page->getPage();
    }

    /**
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        if ($request->method() == 'POST') {
            $post = new Post([
                'id' => $request->getData('id'),
                'idUser' => $this->session->session('idUser'),
                'titre' => $request->postData('titre'),
                'contenu' => $request->postData('contenu'),
            ]);
            if ($post->isValid()) {
                $this->getManager('Post')->save($post);
                $this->session->setFlash("L'article a été modifié");
                $this->reponse->redirect(
                    '/admin/article-'.$request->getData('id').'.html'
                );
            }
            if (!$post->isValid()) {
                $this->session->setFlash(
                    "L'article n'a pas été modifié",
                                         "danger"
                );
            }
        }
        $this->page->addVar(
            "titre",
            "Modifier l'article n°".$request->getData('id')
        );
        $post = $this->getManager('Post')->getUnique($request->getData('id'));
        $this->page->addVar("post", $post);
        $this->page->addVar("id", $request->getData('id'));
        $this->page->getPage();
    }
}
