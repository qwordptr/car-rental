<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 16:01
 */

namespace AppBundle\Controller;

use AppBundle\Service\Interfaces\ICarService;
use AppBundle\Service\Interfaces\INoticeService;
use AppBundle\Service\Interfaces\IOrderService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private $noticeService;
    private $orderService;
    private $carService;

    public function __construct(
        INoticeService $noticeService,
        IOrderService $orderService,
        ICarService $carService
    )
    {
        $this->noticeService = $noticeService;
        $this->orderService = $orderService;
        $this->carService = $carService;
    }

    /**
     * @Route("/order/create", methods="POST", name="create_order", condition="request.isXmlHttpRequest()")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $noticeService = $this->noticeService;
        $orderService = $this->orderService;
        $carService = $this->carService;

        try {
            $notice = $noticeService->get($request->get('notice'));
            $orderService->create(
                $notice,
                $this->getUser(),
                $request->get('startDate'),
                $request->get('endDate'),
                $request->get('days')
            );

            $noticeService->deactivate($notice->getId());
            $carService->deactivate($notice->getCar()->getId());

        }catch (\Exception $exception) {
            $response['message'] = $exception->getMessage();
            $response['status'] = 'error';

            return new Response(json_encode($response), Response::HTTP_BAD_REQUEST);
        }

        return new Response("asda", Response::HTTP_OK);
    }
}