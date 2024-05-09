<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route(
        '/login',
        name: 'login',
        methods: ['get', 'post'],
        locale: 'es'
    )]
    public function login(): Response
    {
        $form = $this->createForm(LoginFormType::class);

        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}