<?php

namespace App\Controller;

use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function index(): Response
    {
        $formCustomer = $this->createForm(CustomerType::class);
        return $this->render('form/index.html.twig', [
            'form' => $formCustomer->createView(),
        ]);
    }
}
