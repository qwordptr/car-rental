<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 06.03.18
 * Time: 21:54
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Car
{
    private $id;
    private $model;
    private $brand;
    private $version;
    private $engine;
    private $fuel;
    private $mileage;
    private $seats;
    private $productionYear;
    private $gearshift;
    private $vin;
    private $airConditioning;
    private $registrationNumber;

    //Related entity not domain property
    private $notices;
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->notices = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo)
    {
        if (!$this->photos instanceof  ArrayCollection) {
            $this->photos = new ArrayCollection();
        }

        $photo->setCar($this);
        $this->photos->add($photo);
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    /**
     * @return mixed
     */
    public function getGearshift()
    {
        return $this->gearshift;
    }

    /**
     * @param mixed $gearshift
     */
    public function setGearshift($gearshift)
    {
        $this->gearshift = $gearshift;
    }

    /**
     * @return mixed
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * @param mixed $vin
     */
    public function setVin($vin)
    {
        $this->vin = $vin;
    }

    /**
     * @return mixed
     */
    public function getAirConditioning()
    {
        return $this->airConditioning;
    }

    /**
     * @param mixed $airConditioning
     */
    public function setAirConditioning($airConditioning)
    {
        $this->airConditioning = $airConditioning;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param mixed $registrationNumber
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param mixed $engine
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    /**
     * @return mixed
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * @param mixed $fuel
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;
    }

    /**
     * @return mixed
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * @param mixed $mileage
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
    }

    /**
     * @return mixed
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * @param mixed $productionYear
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
    }

    public function __toString()
    {
        return $this->brand . ' ' .$this->model . ' ' . $this->engine;
    }

    /**
     * @return ArrayCollection
     */
    public function getNotices()
    {
        return $this->notices;
    }

    /**
     * @param ArrayCollection $notices
     */
    public function setNotices($notices)
    {
        $this->notices = $notices;
    }
}
