<?php

require('vendor/autoload.php');

use HashDemo\Hash;

// ---------- user sets a password ----------

// the user passphrase
$passphrase = "passphrases are better than passwords";

// get a hash
$hash = Hash::make($passphrase);
echo "Hashed password to store in the database: {$hash}" . PHP_EOL;

/**
 * At this point we would store the hash in the database.
 */

// ---------- user logs in ----------

// This is the password that the user gives us when they log in
$suppliedPassphrase = 'password123';

// In real life we would fetch the stored hash out of the database, here we are just hard coding it
$storedHash = $hash;

// this function will calculate the hash of the supplied password and compare it to the stored hash
$passwordIsValid = password_verify($suppliedPassphrase, $storedHash);

if (true === $passwordIsValid) {
    // check if we have adjusted our target difficulty
    if (Hash::needsRehash($storedHash)) {
        $updatedHash = Hash::make($suppliedPassphrase, HASH::NEW_COST);
        echo "Update the stored hash with this one: " . $updatedHash . PHP_EOL;
        // ... replace the stored hash with the updated hash in the database
    }
}

echo "The supplied password is " . ($passwordIsValid ? 'valid' : 'invalid') . PHP_EOL;