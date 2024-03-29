<?php

namespace App\Controller;

use App\Entity\Title;
use App\Form\TitleType;
use App\Form\OfferType;
use App\Repository\TitleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/offer')]
class OfferController extends AbstractController
{
    #[Route('/', name: 'app_offer_index', methods: ['GET'])]
    public function index(TitleRepository $titleRepository): Response
    {
        return $this->render('offer/index.html.twig', [
            'titles' => $titleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TitleRepository $titleRepository): Response
    {
        $title = new Title();
        $form = $this->createForm(TitleType::class, $title);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $titleRepository->save($title, true);

            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offer/new.html.twig', [
            'title' => $title,
            'form' => $form,
        ]);
    }

    #[Route('/apply', name: 'app_offer_apply', methods: ['GET', 'POST'])]
    public function form(): Response
    {
        $form = $this->createForm(OfferType::class);
        return $this->render('offer/_form.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{titleNo}/edit', name: 'app_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Title $title, TitleRepository $titleRepository): Response
    {
        $form = $this->createForm(TitleType::class, $title);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $titleRepository->save($title, true);

            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offer/edit.html.twig', [
            'title' => $title,
            'form' => $form,
        ]);
    }

    #[Route('/{titleNo}', name: 'app_offer_delete', methods: ['POST'])]
    public function delete(Request $request, Title $title, TitleRepository $titleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$title->getTitleNo(), $request->request->get('_token'))) {
            $titleRepository->remove($title, true);
        }

        return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}
