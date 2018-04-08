<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 06.03.18
 * Time: 22:03
 */

namespace AppBundle\Entity;


class Order
{
    public const PENDING = "pending";
    public const APPROVED = "approved";
    public const IN_PROGRESS = "in_progress";
    public const FINISHED_SUCCESSFULLY = "finished_successfully";
    public const FINISHED_WITH_COMMENTS = "finished_with_comments";
    public const REJECTED = "rejected";

    private $id;
    private $notice;
    private $user;
    private $createdAt;
    private $rentFrom;
    private $rentTo;
    private $daysQuantity;
    private $comments;

    /**
     * @return mixed
     */
    public function getDaysQuantity()
    {
        return $this->daysQuantity;
    }

    /**
     * @param mixed $daysQuantity
     */
    public function setDaysQuantity($daysQuantity): void
    {
        $this->daysQuantity = $daysQuantity;
    }

    /**
     * @return mixed
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param mixed $totalCost
     */
    public function setTotalCost($totalCost): void
    {
        $this->totalCost = $totalCost;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
    private $totalCost;
    private $status;

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
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @param mixed $notice
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Order
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @return mixed
     */
    public function getRentTo()
    {
        return $this->rentTo;
    }

    /**
     * @param mixed $rentTo
     */
    public function setRentTo($rentTo)
    {
        $this->rentTo = $rentTo;
    }

    /**
     * @return mixed
     */
    public function getRentFrom()
    {
        return $this->rentFrom;
    }

    /**
     * @param mixed $rentFrom
     */
    public function setRentFrom($rentFrom)
    {
        $this->rentFrom = $rentFrom;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
}
