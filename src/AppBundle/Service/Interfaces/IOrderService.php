<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 16:30
 */


namespace AppBundle\Service\Interfaces;


interface IOrderService
{
    public function create($notice, $user, $startDate, $endDate, $days);
}