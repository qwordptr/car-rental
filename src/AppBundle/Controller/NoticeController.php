<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.03.18
 * Time: 19:59
 */

namespace AppBundle\Controller;

use AppBundle\Form\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\NoticeType;
use AppBundle\Service\Interfaces\INoticeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $defaultData = array('message' => 'Type your message here');

        $search = $request->get('search');
        $category = $request->get('category');

        $notices = $this->noticeService->browse($search, $category);

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