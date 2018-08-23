<?php

namespace Model;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Entity\User;

class UserManager extends PdoConnexion
{

    /**
     *
     * @param type $id
     * @return type
     */
    public function getUnique($id)
    {
        $req = $this->bdd->prepare('SELECT * FROM user WHERE id = :id');
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            '\Entity\User'
        );
        $req->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetch();
    }

    /**
     *
     * @param type $email
     * @param type $mdp
     * @return type
     */
    public function login($email, $mdp)
    {
        $req = $this->bdd->prepare('SELECT * FROM user WHERE email =:email');
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            '\Entity\User'
        );
        $req->execute(['email' => $email]);
        $user = $req->fetch();

        if ($user != null && password_verify($mdp, $user->getMdp())) {
            $_SESSION['auth'] = true;
            return $user;
        }
    }

    /**
     *
     * @param User $user
     * @throws \RuntimeException
     */
    public function save(User $user)
    {
        if (!$user->isValid()) {
            throw new \RuntimeException("L'utilisateur n'est pas valide");
        }
        $user->isNew() ? $this->add($user) : $this->modify($user);
    }

    /**
     *
     * @param User $user
     */
    protected function add(User $user)
    {
        $req = $this->bdd->prepare(
            'INSERT INTO user SET '
            .'nom = :nom, '
            .'prenom = :prenom, '
            .'email = :email, '
            .'mdp = :mdp, '
            .'role =:role'
        );
        $req->bindValue(':nom', $user->getNom());
        $req->bindValue(':prenom', $user->getPrenom());
        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':mdp', $user->getMdp());
        $req->bindValue(':role', $user->getRole());
        $req->execute();

        $user->setId($this->bdd->lastInsertId());
    }

    /**
     *
     * @param User $user
     */
    protected function modify(User $user)
    {
        $req = $this->bdd->prepare(
            'UPDATE user SET '
            .'nom = :nom, '
            .'prenom = :prenom, '
            .'email = :email, '
            .'mdp = :mdp, '
            .'role =:role '
            .'WHERE id = :id'
        );
        $req->bindValue(':nom', $user->getNom());
        $req->bindValue(':prenom', $user->getPrenom());
        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':mdp', $user->getMdp());
        $req->bindValue(':role', $user->getRole());
        $req->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $req->execute();
    }

    /**
     *
     * @param type $id
     */
    public function delete($id)
    {
        $this->bdd->exec('DELETE FROM user WHERE id = '.(int) $id);
    }
}
