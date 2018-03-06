<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 14.10.17
 * Time: 22:08
 */

namespace AppBundle\Service;


use AppBundle\Entity\User;
use AppBundle\Form\RegisterType;
use AppBundle\Repository\UserRepository;
use AppBundle\Service\Interfaces\IEncrypter;
use AppBundle\Service\Interfaces\IUserService;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements IUserService
{
    private $userRepository;
    private $encrypter;

    public function __construct(UserRepository $userRepository, IEncrypter $encrypter)
    {
        $this->userRepository = $userRepository;
        $this->encrypter = $encrypter;
    }

    public function createUser(User $user): void
    {
        $encrypter = $this->encrypter;
        $repository = $this->userRepository;

        $salt = $encrypter->getSalt();
        $user->setSalt($salt);
        $password = $encrypter->getHash($user->getPassword(), $user->getSalt());

        $user->setPassword($password);

        $repository->addUser($user);
    }

    public function getAllUsers() : array
    {
        return $this->userRepository->findAll();
    }
}