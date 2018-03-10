<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 14.10.17
 * Time: 22:37
 */

namespace AppBundle\Service\Interfaces;


use AppBundle\Entity\User;
use AppBundle\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

interface IUserService
{
    public function createUser(User $user);
}