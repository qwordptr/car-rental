<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 15.10.17
 * Time: 12:43
 */

namespace AppBundle\Service;


use AppBundle\Service\Interfaces\IEncrypter;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;

class Encrypter implements IEncrypter
{
    public function getSalt()
    {
        return base64_encode(random_bytes(10));
    }

    public function getHash($password, $salt)
    {
        $e = new Pbkdf2PasswordEncoder();

        return $e->encodePassword($password, $salt);
    }
}