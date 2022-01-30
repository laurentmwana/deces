<?php


namespace App\Controller\Actions;

class User {

    /**
     * @param mixed $password
     * @param mixed $hash
     * 
     * @return User
     */
    public function password ($password, $hash): User {
        return $this;
    }

    /**
     * @param mixed $username
     * 
     * @return User
     */
    public function username ($username): User {
        return $this;
    }

    /**
     * @return mixed
     */
    public function user () {

    }

    /**
     * @param mixed $by
     * 
     * @return User
     */
    public function byUser ($by): User {

        return $this;
    }

    /**
     * @param mixed $token
     * 
     * @return User
     */
    public function token ($token): User {
        return $this;
    }


    /**
     * @return User
     */
    public function create (): User {
        return $this;
    }
}