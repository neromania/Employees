<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/partner')]
class PartnerController extends AbstractController
{
    #[Route('/', name: 'app_partner_index', methods: ['GET'])]
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/index.html.twig', [
            'partners' => $partnerRepository->findAll(),
        ]);
    }
    /*#[Route('/', name: 'app_partner_index', methods: ['GET'])]
    public function showLogos(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/index.html.twig', [
            'logos' => $partnerRepository->findAll()
        ]);
    }*/
}
