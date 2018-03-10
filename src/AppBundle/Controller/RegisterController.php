<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 14.10.17
 * Time: 20:13
 */

namespace AppBundle\Controller;
use AppBundle\Form\RegisterType;
use AppBundle\Service\Interfaces\IUserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RegisterController extends Controller
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $this->test();

        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userService->createUser($user);
            $this->addFlash(
                'success',
                'Zostałeś zarejestrowany. Możesz zalogować się do konta.'
            );

            return $this->redirectToRoute('browse_notices');
        }

        return $this->render('register/register.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @return int
     */
    private function test() : int
    {
        return 1;
    }
}