<?php

namespace Model;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class PdoConnexion
{
    protected $bdd;

    /**
     *
     */
    public function __construct()
    {
        try {
            $bdd = new \PDO(
                'mysql:host='.BDD_SERVEUR.';dbname='.BDD_NAME.';charset=utf8',
                BDD_LOGIN,
                BDD_PASSWORD,
                array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                )
            );

            $this->bdd = $bdd;
        } catch (\PDOException $err) {
            echo 'Échec lors de la connexion : '.$err->getMessage();
        }
    }
}
