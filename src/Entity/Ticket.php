<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Booking", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    /**
     * @ORM\Column(type="string", name="ticket_GuestFirstName")
     */
    private $guestFirstName;

    /**
     * @ORM\Column(type="string", name="ticket_GuestLastName")
     */
    private $guestLastName;

    /**
     * @ORM\Column(type="string", name="ticket_guestCountry")
     */
    private $guestCountry;

    /**
     * @ORM\Column(type="date", name="ticket_guestBirthDate")
     */
    private $guestBirthDate;

    /**
     * @ORM\Column(type="boolean", name="ticket_discount")
     */
    private $discount;

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
    public function getGuestFirstName()
    {
        return $this->guestFirstName;
    }

    /**
     * @param mixed $guestFirstName
     */
    public function setGuestFirstName($guestFirstName): void
    {
        $this->guestFirstName = $guestFirstName;
    }

    /**
     * @return mixed
     */
    public function getGuestLastName()
    {
        return $this->guestLastName;
    }

    /**
     * @param mixed $guestLastName
     */
    public function setGuestLastName($guestLastName): void
    {
        $this->guestLastName = $guestLastName;
    }

    /**
     * @return mixed
     */
    public function getGuestCountry()
    {
        return $this->guestCountry;
    }

    /**
     * @param mixed $guestCountry
     */
    public function setGuestCountry($guestCountry): void
    {
        $this->guestCountry = $guestCountry;
    }

    /**
     * @return mixed
     */
    public function getGuestBirthDate()
    {
        return $this->guestBirthDate;
    }

    /**
     * @param mixed $guestBirthDate
     */
    public function setGuestBirthDate($guestBirthDate): void
    {
        $this->guestBirthDate = $guestBirthDate;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * @param mixed $booking
     */
    public function setBooking(Booking $booking): void
    {
        $this->booking = $booking;
    }


}
