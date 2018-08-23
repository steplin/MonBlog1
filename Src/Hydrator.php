<?php

namespace Blog;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
trait Hydrator
{

    /**
     *
     * @param type $data
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}
