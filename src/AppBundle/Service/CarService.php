<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 22:00
 */

namespace AppBundle\Service;


use AppBundle\Entity\Car;
use AppBundle\Repository\CarRepository;
use AppBundle\Service\Interfaces\ICarService;

class CarService implements ICarService
{

    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function browse()
    {
        $cars = $this->carRepository->findAll();

        return $cars;
    }

    public function create(Car $car)
    {
        // TODO: Implement create() method.
    }
}