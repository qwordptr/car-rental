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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->carRepository->add($car);
    }

    public function getAvailableCars()
    {
        return $this->carRepository->getAvailableCars();
    }

    public function get($id)
    {
        $car = $this->carRepository->find($id);

        if ($car == null)
        {
            throw new NotFoundHttpException("Nie znaleziono pojazdu.");
        }

        return $car;
    }

    public function remove($id)
    {
        $car = $this->carRepository->find($id);

        if ($car == null)
        {
            throw new NotFoundHttpException("Nie znaleziono pojazdu.");
        }

        foreach ($car->getNotices() as $notice) {
            $notice->setIsActive(false);
        }

        $this->carRepository->remove($car);
    }
}