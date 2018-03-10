<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 15.10.17
 * Time: 13:32
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LoginType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        $form = $this->createForm(LoginType::class);

        $lastUsername = $authUtils->getLastUsername(); //add to form
        return $this->render('login/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'form'          => $form->createView()
        ));
    }

}
