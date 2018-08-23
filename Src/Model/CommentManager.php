<?php

namespace Model;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Entity\Comment;

class CommentManager extends PdoConnexion
{

    /**
     *
     * @param type $id
     * @return type
     */
    public function getUnique($id)
    {
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE id =:id");
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            '\Entity\Comment'
        );
        $req->bindValue(":id", $id);
        $req->execute();

        return $req->fetch();
    }

    /**
     *
     * @param type $post
     * @param type $valide
     * @return type
     */
    public function getList($post, $valide)
    {
        $req = $this->bdd->prepare(
            "SELECT comment.id, comment.idPost, comment.idUser, "
            ."comment.contenu, comment.valide, comment.dateAjout, "
            ."concat(user.nom,' ',user.prenom) as userName "
            ."FROM comment INNER JOIN user on "
            ."user.id = comment.idUser "
            ."WHERE idPost =:post AND valide=:valide  "
            ."ORDER BY dateAjout DESC LIMIT 5"
        );
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            '\Entity\Comment'
        );
        $req->bindValue(':post', $post);
        $req->bindValue(':valide', $valide);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     *
     * @param type $valide
     * @return type
     */
    public function listeComments($valide)
    {
        $req = $this->bdd->prepare(
            "SELECT count(comment.id) as nbcomment, post.id, post.titre, "
            ."post.contenu, MAX(comment.dateAjout) as dateAjout, "
            ."post.dateModif, concat(user.nom,' ',user.prenom) as userName, "
            ."comment.valide, comment.idUser "
            ."FROM post INNER JOIN user on user.id = post.idUser "
            ."INNER JOIN comment on post.id = comment.idPost "
            ."WHERE comment.valide =:valide "
            ."GROUP BY post.id"
        );

        $req->execute(array('valide' => $valide));
        return $req->fetchAll();
    }

    /**
     *
     * @return type
     */
    public function notValid()
    {
        $req = $this->bdd->query("SELECT * FROM `comment` WHERE `valide` = 0");
        return $req->fetchAll();
    }

    /**
     *
     * @param Comment $comment
     * @throws \RuntimeException
     */
    public function save(Comment $comment)
    {
        if (!$comment->isValid()) {
            throw new \RuntimeException("Le commentaire n'est pas valide");
        }
        $comment->isNew() ? $this->add($comment) : $this->modify($comment);
    }

    /**
     *
     * @param Comment $comment
     */
    protected function add(Comment $comment)
    {
        $req = $this->bdd->prepare(
            'INSERT INTO comment SET '
            .'idPost =:idPost, '
            .'idUser =:idUser, '
            .'contenu =:contenu, '
            .'dateAjout = Now()'
        );
        $req->bindValue(':idPost', $comment->getIdPost());
        $req->bindValue(':idUser', $comment->getIdUser());
        $req->bindValue(':contenu', $comment->getContenu());
        $req->execute();

        $comment->setId($this->bdd->lastInsertId());
    }

    /**
     *
     * @param Comment $comment
     */
    protected function modify(Comment $comment)
    {
        $req = $this->bdd->prepare(
            'UPDATE comment SET '
            .'idPost =:idPost, '
            .'idUser =:idUser, '
            .'contenu =:contenu, '
            .'valide =:valide, '
            .'dateAjout =:dateAjout '
            .'WHERE id = :id'
        );
        $req->bindValue(':idPost', $comment->getIdPost());
        $req->bindValue(':idUser', $comment->getIdUser());
        $req->bindValue(':contenu', $comment->getContenu());
        $req->bindValue(':valide', $comment->getValide());
        $req->bindValue(':dateAjout', $comment->getDateAjout());
        $req->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $req->execute();
    }

    /**
     *
     * @param type $id
     */
    public function publier($id)
    {
        $req = $this->bdd->prepare(
            'UPDATE comment SET valide = 1, dateAjout = NOW()  WHERE id = :id'
        );

        $req->bindValue(':id', $id, \PDO::PARAM_INT);

        $req->execute();
    }

    /**
     *
     * @param type $id
     */
    public function delete($id)
    {
        $this->bdd->exec('DELETE FROM comment WHERE id = '.(int) $id);
    }

    /**
     *
     * @param type $idPost
     */
    public function deleteAllComments($idPost)
    {
        $this->bdd->exec(
            'DELETE FROM comment WHERE idPost = '.(int) $idPost
        );
    }
}
