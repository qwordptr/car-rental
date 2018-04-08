<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.04.18
 * Time: 11:53
 */

namespace AppBundle\Controller;


use AppBundle\Service\Interfaces\IOrderService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    private $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @Route("/profile/orders", name="user_orders", options={"expose"=true})
     */
    public function myOrdersAction()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $orderService = $this->orderService;
        $orders = $orderService->getUserOrders($userId);

        return $this->render('profile/orders.html.twig', ['orders' => $orders]);
    }
}