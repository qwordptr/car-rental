<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 16:32
 */

namespace AppBundle\Service;

use AppBundle\Entity\Order;
use Symfony\Component\Validator\Constraint;
use AppBundle\Repository\OrderRepository;
use AppBundle\Service\Interfaces\IOrderService;
use Symfony\Component\Validator\Constraints\Date;

class OrderService implements IOrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create($notice, $user, $startDate, $endDate, $days)
    {
        //change to form
        if ($notice == null)
        {
            throw new \InvalidArgumentException("Nie ma takiego ogłoszenia");
        }

        $startDate = new \DateTime($startDate);
        $endDate = new \DateTime($endDate);

        if ($startDate === $endDate) {

            throw new \InvalidArgumentException("Daty wypożyczenia i zwrotu nie mogą być takei same.");
        }

        if ($startDate >= $endDate) {
            throw new \InvalidArgumentException("Data wypożyczenia nie może być większa lub równa niż data zwrotu.");
        }

        $order = new Order();
        $order->setNotice($notice);
        $order->setUser($user);
        $order->setCreatedAt(new \DateTime());
        $order->setRentFrom($startDate);
        $order->setRentTo($endDate);

        $this->orderRepository->save($order);
    }
}