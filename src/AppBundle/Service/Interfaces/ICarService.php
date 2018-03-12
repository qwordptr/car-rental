<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.03.18
 * Time: 20:44
 */

namespace AppBundle\Service\Interfaces;


use AppBundle\Entity\Car;

interface ICarService
{
    public function browse();
    public function create(Car $car);
    public function getAvailableCars();
    public function get($id);
}