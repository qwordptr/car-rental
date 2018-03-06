<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 15.10.17
 * Time: 12:42
 */

namespace AppBundle\Service\Interfaces;


interface IEncrypter
{
    public function getSalt();
    public function getHash($password, $salt);

}