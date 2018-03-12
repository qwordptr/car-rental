<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 12.03.18
 * Time: 15:58
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Form\NoticeType;
use AppBundle\Service\Interfaces\ICarService;
use AppBundle\Service\Interfaces\INoticeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoticeController extends Controller
{
    private $noticeService;
    private $carService;

    public function __construct(INoticeService $noticeService, ICarService $carService)
    {
        $this->noticeService = $noticeService;
        $this->carService = $carService;
    }

    /**
     * @Route("/admin/notice/list", name="admin_browse_notice")
     */
    public function indexAction()
    {
        $notices = $this->noticeService->browse();

        return $this->render('notice/admin/list.html.twig', ['notices' => $notices]);
    }

    /**
     * @Route("/admin/notice/create", name="admin_create_notice")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $service = $this->noticeService;
        $cars = $this->carService->getAvailableCars();
        $form = $this->createForm(NoticeType::class, null, ['cars' => $cars]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->create($form->getData());

            $this->addFlash('success', 'Nowe ogłoszenie zostało dodane.');
            $this->redirectToRoute('admin_browse_notice');
        }

        return $this->render('notice/admin/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/notice/{id}/edit", name="admin_edit_notice", requirements={"id": "\d+"})
     * @param Request $request
     * @return Response
     */
    public function editAction(Request $request)
    {
        $service = $this->noticeService;
        $cars = $this->carService->getAvailableCars();
        $notice = $service->get($request->get('id'));
        $form = $this->createForm(NoticeType::class, $notice, ['cars' => $cars]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->update($form->getData());

            $this->addFlash('success', 'Ogłoszenie zostało zaktualizowane.');
        }

        return $this->render('notice/admin/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/notice/{id}", name="admin_deactivate_notice",
     *     requirements={"id": "\d+"}, condition="request.isXmlHttpRequest()",
     *     methods={"DELETE","HEAD"})
     * @param Request $request
     * @return Response
     */
    public function removeAction(Request $request)
    {
        $service = $this->noticeService;

        $response['message'] = 'Ogłosznie zostało usunięte.';
        $response['type'] = 'success';
        $response['id'] = $request->get('id');
        try {
            $service->deactivate($request->get('id'));

            return new Response(json_encode($response));

        }catch (\Exception $exception) {
            $response['message'] = $exception->getMessage();
            $response['type'] = 'error';

            return new Response(json_encode($response), Response::HTTP_BAD_REQUEST);
        }
    }

}