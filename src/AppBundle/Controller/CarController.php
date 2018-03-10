<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 21:53
 */

namespace AppBundle\Controller;


use AppBundle\Service\Interfaces\ICarService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CarController extends Controller
{
    private $carService;

    public function __construct(ICarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @Route("/admin/car", name="browse_car")
     */
    public function browseAction()
    {
        $cars = $this->carService->browse();

        return $this->render("car/browse.html.twig", ['cars' => $cars]);
    }
}