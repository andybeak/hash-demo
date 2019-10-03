# Readme

A trivial example of using PHP password hashing.

To run the demo:

    composer dump-autoload
    php index.php

Using the provided PHP functions is recommended as it only supports secure
algorithms and the `password_verify()` function is safe against timing attacks according to the [manual](https://www.php.net/manual/en/function.password-verify.php).

