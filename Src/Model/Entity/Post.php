<?php

namespace Entity;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Post extends Entity
{
    protected $idUser;
    protected $titre;
    protected $contenu;
    protected $dateAjout;
    protected $dateModif;
    protected $userName;

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
    public function getTitre()
    {
        return $this->titre;
    }

    public function getContenu()
    {
        return $this->contenu;
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
    public function getDateModif()
    {
        return $this->dateModif;
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
     * @param type $titre
     */
    public function setTitre($titre)
    {
        if (is_numeric($titre) || empty($titre)) {
            $this->erreurs[] = 1;
        }

        $this->titre = $titre;
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
     * @param \DateTime $dateAjout
     */
    public function setDateAjout(\DateTime $dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     *
     * @param \DateTime $dateModif
     */
    public function setDateModif(\DateTime $dateModif)
    {
        $this->dateModif = $dateModif;
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
