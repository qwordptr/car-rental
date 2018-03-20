<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 20.03.18
 * Time: 20:19
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Form\NoticeType;
use AppBundle\Service\Interfaces\ICarService;
use AppBundle\Service\Interfaces\INoticeService;
use AppBundle\Service\Interfaces\IOrderService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;



class OrderController extends Controller
{
    private $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @Route("/admin/order/{id}", name="admin_order_details", requirements={"id": "\d+"})
     * @param Request $request
     * @return Response
     */
    public function detailsAction(Request $request)
    {
        $order = $this->orderService->get($request->get('id'));

        return $this->render('order/admin/details.html.twig', ['order' => $order, 'status' => 3]);
    }

    /**
     * @Route("/admin/order/{id}/approve", name="admin_order_approve", requirements={"id": "\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function approveAction(Request $request)
    {
        $this->orderService->approve($request->get('id'));
        $this->addFlash('success', 'Zamówienie zostało zatwierdzone pomyślnie.');

        return $this->redirectToRoute('admin_order_details', ['id' => $request->get('id')]);
    }

    /**
     * @Route("/admin/order/{id}/reject", name="admin_order_reject", requirements={"id": "\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function rejectAction(Request $request)
    {
        $this->orderService->reject($request->get('id'));
        $this->addFlash('success', 'Zamówienie zostało zatwierdzone odrzucone.');

        return $this->redirectToRoute('admin_order_details', ['id' => $request->get('id')]);
    }

    /**
     * @Route("/admin/order/list", name="admin_order_browse")
     * @return Response
     */
    public function browseAction()
    {
        $orders = $this->orderService->browseAll();

        return $this->render('order/admin/browse-all.html.twig', ['orders' => $orders]);
    }
}