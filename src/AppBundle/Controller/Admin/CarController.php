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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarController extends Controller
{
    private $carService;

    public function __construct(ICarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @Route("/admin/car/create", name="admin_create_car")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->carService->create($form->getData());
            $this->addFlash('success', 'Nowy samochód został dodany do bazy.');
        }

        return $this->render('car/create.html.twig', ['form' => $form->createView() ]);
    }

    /**
     * @Route("/admin/car/{id}", name="admin_details_car")
     */
    public function detailsAction()
    {
        //TODO: Method must be implemented
    }

    /**
     * @Route("/admin/car", name="admin_browse_car")
     */
    public function browseAction()
    {
        $cars = $this->carService->browse();

        return $this->render("car/browse.html.twig", ['cars' => $cars]);
    }
}