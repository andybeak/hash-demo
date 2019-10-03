<?php

namespace HashDemo;

class Hash
{
    /**
     * The default cost for the algorithm
     */
    const DEFAULT_COST = 12;

    /**
     * Set a minimum cost that the class will allow
     */
    const MIN_COST = 10;

    /**
     * For arguments sake lets say that hardware is faster so we need to have a cost of 13
     */
    const NEW_COST = 13;

    /**
     * @param string $password
     * @param int $cost
     * @return string
     */
    public static function make(string $password, $cost = self::DEFAULT_COST): string
    {
        $options = [
            'cost' => max($cost, self::MIN_COST)
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /**
     * Checks if the supplied hash meets the requirements laid out by the algorithm and options
     * This allows us to incrementally roll out rehashing user passwords.  When a user logs in
     * we check if their hash needs to be updated and use that opportunity to rehash the password.
     *
     * @param string $hash
     * @return bool
     */
    public static function needsRehash(string $hash): bool
    {
        $options = [
            'cost' => self::NEW_COST
        ];
        return password_needs_rehash($hash, PASSWORD_BCRYPT, $options);
    }
}
