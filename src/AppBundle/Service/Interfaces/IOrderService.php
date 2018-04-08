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
    public function get($id);
    public function approve($id);
    public function setInProgress($id);
    public function finishSuccessfully($id);
    public function finishWithComments($id);
    public function getUserOrders($userId);
    public function reject($id);
    public function browseAll();
}