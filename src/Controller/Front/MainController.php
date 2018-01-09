<?php

namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }


}

