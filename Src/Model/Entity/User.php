<?php

namespace Entity;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class User extends Entity
{
    protected $nom;
    protected $prenom;
    protected $email;
    protected $mdp;
    protected $role;

    /**
     *
     * @return type
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * @return type
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     *
     * @return type
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return type
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     *
     * @return type
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     *
     * @param type $nom
     */
    public function setNom($nom)
    {
        if (is_numeric($nom) || empty($nom)) {
            $this->erreurs[] = 1;
        }
        $nom = utf8_decode($nom);
        $nom = strtoupper($nom);
        $nom = utf8_encode($nom);

        $this->nom = $nom;
    }

    /**
     *
     * @param type $prenom
     */
    public function setPrenom($prenom)
    {
        if (is_numeric($prenom) || empty($prenom)) {
            $this->erreurs[] = 1;
        }
        $this->prenom = ucfirst($prenom);
    }

    /**
     *
     * @param type $email
     */
    public function setEmail($email)
    {
        if (!empty($email)) {
            $valide = preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email);

            if (!$valide) {
                $this->erreurs[] = 1;
            }
        }

        $this->email = $email;
    }

    /**
     *
     * @param type $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }

    /**
     *
     * @param type $role
     */
    public function setRole($role)
    {
        if (!is_numeric($role) || empty($role)) {
            $this->erreurs[] = 1;
        }

        $this->role = $role;
    }
}
