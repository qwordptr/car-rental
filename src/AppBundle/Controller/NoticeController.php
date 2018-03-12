<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.03.18
 * Time: 19:59
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\NoticeType;
use AppBundle\Service\Interfaces\INoticeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoticeController extends Controller
{
    private $noticeService;

    public function __construct(INoticeService $noticeService)
    {
        $this->noticeService = $noticeService;
    }

    /**
     * @Route("/", name="browse_notices")
     * @param Request $request
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $notices = $this->noticeService->browse();

        return $this->render('notice/browse.html.twig', ['notices' => $notices]);
    }

    /**
     * @Route("/notice/{id}", name="notice_details", requirements={"id": "\d+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction($id)
    {
        $notice = $this->noticeService->get($id);

        return $this->render('notice/details.html.twig', ['notice' => $notice]);
    }
}