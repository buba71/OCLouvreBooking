<?php

namespace App\Controller\Front;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class TicketingController
{
    public function booking(Environment $twig)
    {
        return new Response($twig->render('Frontend/Ticketing/booking.html.twig'));
    }

}