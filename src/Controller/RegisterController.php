<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{

    #[Route(
        '/register',
        name: 'register',
        methods: ['get', 'post'],
        locale: 'es'
    )]
    public function login(): Response
    {
        return $this->render('register.html.twig');
    }
}