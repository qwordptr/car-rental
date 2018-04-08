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
use AppBundle\Repository\PhotoRepository;
use AppBundle\Service\Interfaces\ICarService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarService implements ICarService
{

    private $carRepository;
    private $photoRepository;

    public function __construct(CarRepository $carRepository, PhotoRepository $photoRepository)
    {
        $this->carRepository = $carRepository;
        $this->photoRepository = $photoRepository;
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

    public function update(Car $car)
    {
        $this->carRepository->update($car);
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

    public function getPhotosDiff(Car $updatedCar)
    {
        $updatedPhotos = $updatedCar->getPhotos();
        $originalPhotos = $this->photoRepository->getCarPhotos($updatedCar);

        $diff['persisted'] = new ArrayCollection();
        $diff['removed'] = new ArrayCollection();
        $diff['new'] = $updatedPhotos;


        foreach ($originalPhotos as $originalPhoto) {
            if (!$updatedPhotos->contains($originalPhoto))
            {
                $diff['removed']->add($originalPhoto);
            }else if ($updatedPhotos->contains($originalPhoto))
            {
                $diff['persisted']->add($originalPhoto);
                $diff['new']->removeElement($originalPhoto);
            }
        }

        return $diff;
    }
}