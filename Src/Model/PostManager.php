<?php

namespace Model;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Entity\Post;

class PostManager extends PdoConnexion
{

    /**
     *
     * @param type $id
     * @return type
     */
    public function getUnique($id)
    {
        $req = $this->bdd->prepare(
            "SELECT post.id, post.idUser, "
            ."post.titre, post.contenu, post.dateAjout, post.dateModif, "
            ."concat(user.nom,' ',user.prenom) as userName "
            ."FROM post INNER JOIN user on "
            ."user.id = post.idUser "
            ."WHERE post.id =:id "
        );
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            '\Entity\Post'
        );
        $req->bindValue(":id", $id);
        $req->execute();

        return $req->fetch();
    }

    /**
     *
     * @return type
     */
    public function getAll()
    {
        $req = $this->bdd->query(
            "SELECT post.id, post.idUser, "
            ."post.titre, post.contenu, post.dateAjout, post.dateModif, "
            ."concat(user.nom,' ',user.prenom) as userName "
            ."FROM post INNER JOIN user on "
            ."user.id = post.idUser "
            ."ORDER BY dateAjout DESC"
        );
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            '\Entity\Post'
        );
        return $req->fetchAll();
    }

    /**
     *
     * @param Post $post
     * @throws \RuntimeException
     */
    public function save(Post $post)
    {
        if (!$post->isValid()) {
            throw new \RuntimeException("Le billet n'est pas valide");
        }
        $post->isNew() ? $this->add($post) : $this->modify($post);
    }

    /**
     *
     * @param Post $post
     */
    protected function add(Post $post)
    {
        $req = $this->bdd->prepare(
            'INSERT INTO post SET '
            .'idUser = :idUser, '
            .'titre = :titre, '
            .'contenu = :contenu, '
            .'dateAjout = Now(), '
            .'dateModif = Now()'
        );
        $req->bindValue(':idUser', $post->getIdUser());
        $req->bindValue(':titre', $post->getTitre());
        $req->bindValue(':contenu', $post->getContenu());
        $req->execute();

        $post->setId($this->bdd->lastInsertId());
    }

    /**
     *
     * @param Post $post
     */
    protected function modify(Post $post)
    {
        $req = $this->bdd->prepare(
            'UPDATE post SET '
            .'idUser = :idUser, '
            .'titre = :titre, '
            .'contenu = :contenu, '
            .'dateModif = Now() '
            .'WHERE id = :id'
        );
        $req->bindValue(':idUser', $post->getIdUser());
        $req->bindValue(':titre', $post->getTitre());
        $req->bindValue(':contenu', $post->getContenu());
        $req->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        $req->execute();
    }

    /**
     *
     * @param type $id
     */
    public function delete($id)
    {
        $this->bdd->exec('DELETE FROM post WHERE id = '.(int) $id);
    }
}
