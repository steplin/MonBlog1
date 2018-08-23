<?php

namespace Entity;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Comment extends Entity
{
    protected $idPost;
    protected $idUser;
    protected $contenu;
    protected $valide;
    protected $dateAjout;
    protected $userName;

    /**
     *
     * @return type
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     *
     * @return type
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     *
     * @return type
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     *
     * @return type
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     *
     * @return type
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     *
     * @return type
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     *
     * @param type $idPost
     */
    public function setIdPost($idPost)
    {
        if (!is_numeric($idPost) || empty($idPost)) {
            $this->erreurs[] = 1;
        }
        $this->idPost = $idPost;
    }

    /**
     *
     * @param type $idUser
     */
    public function setIdUser($idUser)
    {
        if (!is_numeric($idUser) || empty($idUser)) {
            $this->erreurs[] = 1;
        }
        $this->idUser = $idUser;
    }

    /**
     *
     * @param type $contenu
     */
    public function setContenu($contenu)
    {
        if (is_numeric($contenu) || empty($contenu)) {
            $this->erreurs[] = 1;
        }

        $this->contenu = $contenu;
    }

    /**
     *
     * @param type $valide
     */
    public function setValide($valide)
    {
        if ($valide != 0 && $valide != 1) {
            $this->erreurs[] = 1;
        }

        $this->valide = $valide;
    }

    /**
     *
     * @param \DateTime $dateAjout
     */
    public function setDateAjout(\DateTime $dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     *
     * @param type $userName
     */
    public function setUserName($userName)
    {
        if (is_numeric($userName) || empty($userName)) {
            $this->erreurs[] = 1;
        }
        $this->userName = $userName;
    }
}
