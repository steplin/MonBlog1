<?php

namespace Entity;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
abstract class Entity implements \ArrayAccess
{
    use \Blog\Hydrator;
    protected $erreurs = [];
    protected $id;

    /**
     *
     * @param array $donnees
     */
    public function __construct(array $donnees = [])
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    /**
     *
     * @return type
     */
    public function isValid()
    {
        return empty($this->erreurs);
    }

    /**
     *
     * @return type
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     *
     * @return boolean
     */
    public function isExist()
    {
        if (isset($this->id) && !empty($this->id)) {
            return true;
        }
    }

    /**
     *
     * @return type
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param type $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     *
     * @param type $value
     */
    public function setErreurs($value)
    {
        $this->erreurs[] = $value;
    }

    /**
     *
     * @param type $var
     * @return type
     */
    public function offsetGet($var)
    {
        $method = 'get'.ucfirst($var);

        if (isset($this->$var) && is_callable([$this, $method])) {
            return $this->$method();
        }
    }

    /**
     *
     * @param type $var
     * @param type $value
     */
    public function offsetSet($var, $value)
    {
        $method = 'set'.ucfirst($var);

        if (isset($this->$var) && is_callable([$this, $method])) {
            $this->$method($value);
        }
    }

    /**
     *
     * @param type $var
     * @return type
     */
    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable([$this, $var]);
    }

    /**
     *
     * @param type $var
     */
    public function offsetUnset($var)
    {
        unset($var);
    }
}
