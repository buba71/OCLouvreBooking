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
     * @ORM\Column(type="integer", name="ticket_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=30, name="ticket_guestFirstName")
     */
    private $guestFirstName;

    /**
     * @ORM\Column(type="string",length=30, name="ticket_guestLastName")
     */
    private $guestLastName;

    /**
     * @ORM\Column(type="string",length=30, name="ticket_guestCountry")
     */
    private $guestCountry;

    /**
     * @ORM\Column(type="date", name="ticket_birthDate")
     */
    private $birthDate;

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
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
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




}
