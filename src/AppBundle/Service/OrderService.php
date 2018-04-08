<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10.03.18
 * Time: 16:32
 */

namespace AppBundle\Service;

use AppBundle\Entity\Order;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $order->setStatus(Order::PENDING);
        $order->setDaysQuantity($days);
        $order->setTotalCost($notice->getPrice() * $days);

        $this->orderRepository->save($order);
    }

    public function get($id)
    {
        $order = $this->orderRepository->find($id);

        if ($order == null)
        {
            throw new NotFoundHttpException("Ogłoszenie nie zostało znalezione.");
        }

        return $order;
    }

    public function approve($id)
    {
        $order = $this->orderRepository->find($id);

        if ($order == null)
        {
            throw new NotFoundHttpException("Ogłoszenie nie zostało znalezione.");
        }

        $order->setStatus(Order::APPROVED);

        $this->orderRepository->update($order);
    }

    public function setInProgress($id)
    {
        $order = $this->orderRepository->find($id);

        if ($order == null)
        {
            throw new NotFoundHttpException("Ogłoszenie nie zostało znalezione.");
        }

        $order->setStatus(Order::IN_PROGRESS);

        $this->orderRepository->update($order);
    }

    public function finishSuccessfully($id)
    {
        $order = $this->orderRepository->find($id);

        if ($order == null)
        {
            throw new NotFoundHttpException("Ogłoszenie nie zostało znalezione.");
        }

        $order->setStatus(Order::FINISHED_SUCCESSFULLY);

        $this->orderRepository->update($order);
    }

    public function finishWithComments($id)
    {
        $order = $this->orderRepository->find($id);

        if ($order == null)
        {
            throw new NotFoundHttpException("Ogłoszenie nie zostało znalezione.");
        }

        $order->setStatus(Order::FINISHED_WITH_COMMENTS);

        $this->orderRepository->update($order);
    }

    public function reject($id)
    {
        $order = $this->orderRepository->find($id);

        if ($order == null)
        {
            throw new NotFoundHttpException("Ogłoszenie nie zostało znalezione.");
        }

        $order->setStatus(Order::REJECTED);

        $this->orderRepository->update($order);
    }

    public function getUserOrders($userId)
    {
        $orders = $this->orderRepository->getUserOrders($userId);

        return $orders;
    }

    public function browseAll()
    {
        $orders = $this->orderRepository->findAll();

        return $orders;
    }
}