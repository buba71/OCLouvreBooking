<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="order_id")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="order_bookingDate")
     */
    private $bookingDate;

    /**
     * @ORM\Column(type="string",length=10, name="order_ticketCategory")
     */
    private $ticketCategory;

    /**
     * @ORM\Column(type="string", length=30, name="order_userMail")
     */
    private $userMail;

    /**
     * @ORM\Column(type="integer", length=3, name="order_ticketQuantity", unique=true)
     */
    private $ticketQuantity;

    /**
     * @ORM\Column(type="integer", length=5, name="order_amount")
     */
    private $amount;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * @param mixed $bookingDate
     */
    public function setBookingDate($bookingDate): void
    {
        $this->bookingDate = $bookingDate;
    }

    /**
     * @return mixed
     */
    public function getTicketCategory()
    {
        return $this->ticketCategory;
    }

    /**
     * @param mixed $ticketCategory
     */
    public function setTicketCategory($ticketCategory): void
    {
        $this->ticketCategory = $ticketCategory;
    }

    /**
     * @return mixed
     */
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * @param mixed $userMail
     */
    public function setUserMail($userMail): void
    {
        $this->userMail = $userMail;
    }

    /**
     * @return mixed
     */
    public function getTicketQuantity()
    {
        return $this->ticketQuantity;
    }

    /**
     * @param mixed $ticketQuantity
     */
    public function setTicketQuantity($ticketQuantity): void
    {
        $this->ticketQuantity = $ticketQuantity;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }




}
