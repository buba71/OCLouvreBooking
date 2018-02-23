<?php

namespace App\Controller\Front;

use App\Entity\Booking;
use App\Entity\Ticket;
use App\Form\BookingType;
use App\Form\TicketsType;
use App\Form\TicketType;
use App\Services\Mailing;
use App\Services\PriceCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;


class TicketingController
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

    public function register(Environment $twig, FormFactoryInterface $formFactory,RouterInterface $router,EntityManagerInterface $entityManager, Request $request, PriceCalculator $priceCalculator, $id)
    {
        $booking = $entityManager->getRepository(Booking::class)->find($id);
        $ticketQuantity = $booking->getTicketQuantity();

        $form = $formFactory->createBuilder(TicketsType::class, null)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tickets = $form->get('tickets')->getData();

            $bookingAmount = 0;

            foreach ($tickets as $ticket)
            {
                $ticketPrice = $priceCalculator->calculating($ticket->getGuestBirthDate(), $ticket->getDiscount());
                $ticket->setPrice($ticketPrice);
                $bookingAmount += $ticketPrice;
                $booking->addTicket($ticket);
            }

            $booking->setAmount($bookingAmount);
            $entityManager->flush();

            $url = $router->generate('booking_checkout', array(
                'id' => $booking->getId()
            ));
            return new RedirectResponse($url);

        }

        return new Response($twig->render('Frontend/Ticketing/register.html.twig', array(
            'ticketQuantity' => $ticketQuantity,
            'form' => $form->createView(),
        )));


    }

    public function checkout (EntityManagerInterface $entityManager, Environment $twig, RouterInterface $router,Session $session, Request $request, $id)
    {
        $currentBooking = $entityManager->getRepository(Booking::class)->find($id);

        $error = false;
        if (($request->get('stripeToken'))  && !empty($_POST['card_name'])) {

            try {
                \Stripe\Stripe::setApiKey("sk_test_6G64v0ymQwWDFy39GaA6pPTD");
                // Token is created using Checkout or Elements!
                // Get the payment token ID submitted by the form:
                $token = $request->get('stripeToken');
                $cardName = $_POST['card_name'];

                // Create a custumer on stripe account
                $customer = \Stripe\Customer::create(array(
                    "source" => $token,
                    "email" => "d.delima@sfr.fr",
                    "description" => "",
                    "metadata" => array('Name' => $cardName)
                ));

                // Submit the payment
                $charge = \Stripe\Charge::create(array(
                    "amount" => 6000,
                    "currency" => "eur",
                    "description" => "Example charge",
                    "customer" => $customer->id
                ));

            } catch (\Stripe\Error\Card $e) {
                $error = 'there was a problem charging your card: ' . $e->getMessage();
                $session->getFlashBag()->add('success', $error);
            }

            // If card is valide
            if (!$error && ($charge->paid == true)) {
                $url = $router->generate('booking_success');
                return new RedirectResponse($url);
            }
        }


        return new Response($twig->render('Frontend/Ticketing/checkout.html.twig', array(
            'amount' => $currentBooking->getAmount(),
            'ticketQuantity' => $currentBooking->getTicketQuantity(),
            'mail' => $currentBooking->getUserMail(),
            'bookingDate' => $currentBooking->getBookingDate()->format('d/m/y'),
        )));
    }

    public function paymentSuccess(Environment $twig, Mailing $mailer)
    {
        $mailer->sendMail();

        return new Response($twig->render('Frontend/Ticketing/succeed.html.twig'));
    }



}