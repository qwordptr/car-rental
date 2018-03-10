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
    private $id;
    private $notice;
    private $user;
    private $createdAt;
    private $rentFrom;
    private $rentTo;

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
}
