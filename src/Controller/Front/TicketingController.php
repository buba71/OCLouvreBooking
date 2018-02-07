<?php

namespace App\Controller\Front;

use App\Entity\Booking;
use App\Entity\Ticket;
use App\Form\BookingType;
use App\Form\TicketsType;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;


class TicketingController extends Controller
{
    public function booking(Environment $twig, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, RouterInterface $router, Request $request): Response
    {
        $booking = new Booking();

        $form = $formFactory->createBuilder(BookingType::class, $booking)->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $tmpAmount = 1;
            $booking->setAmount($tmpAmount);

            $em = $entityManager;
            $em->persist($booking);
            $em->flush();

            $id = $booking->getId();

            $url = $router->generate('booking_register', array(
                'id' => $id
            ));
            return new RedirectResponse($url);


        }

        return new Response($twig->render('Frontend/Ticketing/booking.html.twig', array(
            'form' => $form->createView()
        )));
    }

    public function register(Environment $twig, FormFactoryInterface $formFactory,RouterInterface $router,EntityManagerInterface $entityManager, Request $request, $id)
    {

        $booking = $entityManager->getRepository(Booking::class)->find($id);
        $ticketQuantity = $booking->getTicketQuantity();


        $form = $formFactory->createBuilder(TicketsType::class, null)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tickets = $form->get('tickets')->getData();

            foreach ($tickets as $ticket)
            {
                echo '<pre>';
                var_dump($ticket);
                echo'</pre>';

                $booking->addTicket($ticket);
            }

            $entityManager->flush();

            $url = $router->generate('booking_payment');
            return new RedirectResponse($url);

        }

        return new Response($twig->render('Frontend/Ticketing/register.html.twig', array(
            'ticketQuantity' => $ticketQuantity,
            'form' => $form->createView()
        )));


    }

    public function payment (Environment $twig)
    {
        return new Response($twig->render('Frontend/Ticketing/payment.html.twig'));
    }



}