<?php

/******************************
 * Comprobar validez del correo
 ******************************/
function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

/******************************
 * Comprobar validez de la contraseña
 ******************************/
function validatePassword($password)
{
    // Contraseña dada $ password  =  'user-input-pass' ; 
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    }

    return true;
}
