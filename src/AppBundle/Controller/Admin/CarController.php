<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 21:53
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Form\CarType;
use AppBundle\Service\Interfaces\ICarService;
use AppBundle\Service\Interfaces\IFileUploader;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    private $carService;

    public function __construct(ICarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @Route("/admin/car/create", name="admin_create_car")
     * @param Request $request
     * @param IFileUploader $fileUploader
     * @return Response
     */
    public function createAction(Request $request, IFileUploader $fileUploader)
    {
        $carService = $this->carService;
        $form = $this->createForm(CarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            $photos = $car->getPhotos();

            foreach ($photos as $file)
            {
                $photo = $fileUploader->uploadFile($file);
                $car->addPhoto($photo);

            }

            $carService->create($car);
            $this->addFlash('success', 'Nowy samochód został dodany do bazy.');
        }

        return $this->render('car/admin/create.html.twig', ['form' => $form->createView() ]);
    }

    /**
     * @Route("/admin/car/{id}", name="admin_details_car", requirements={"id": "\d+"})
     */
    public function detailsAction(Request $request)
    {
        $car = $this->carService->get($request->get('id'));

        return $this->render('car/admin/details.html.twig', ['car' => $car]);
    }

    /**
     * @Route("/admin/car/{id}/edit", name="admin_edit_car", requirements={"id": "\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $car = $this->carService->get($request->get('id'));
        $form = $this->createForm(CarType::class, $car);

        if ($form->isSubmitted() && $form->isValid())
        {
            //TODO: DOROBIĆ ZAPIS
        }

        return $this->render('car/admin/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/car/{id}/remove", name="admin_remove_car",
     *     requirements={"id": "\d+"}, condition="request.isXmlHttpRequest()",
     *     methods={"DELETE","HEAD"})
     * )
     * @param Request $request
     * @return Response
     */
    public function removeAction(Request $request)
    {
        $response['message'] = 'Ogłosznie zostało usunięte.';
        $response['type'] = 'success';
        $response['id'] = $request->get('id');
        try {
            $this->carService->remove($request->get('id'));

            return new Response(json_encode($response));

        }catch (\Exception $exception) {
            $response['message'] = $exception->getMessage();
            $response['type'] = 'error';

            return new Response(json_encode($response), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Route("/admin/car", name="admin_browse_car")
     */
    public function browseAction()
    {
        $cars = $this->carService->browse();

        return $this->render("car/admin/browse.html.twig", ['cars' => $cars]);
    }
}