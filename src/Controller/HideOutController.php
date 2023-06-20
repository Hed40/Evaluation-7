<?php

namespace App\Controller;

use App\Entity\HideOut;
use App\Form\HideOutType;
use App\Repository\HideOutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hide_out')]
class HideOutController extends AbstractController
{
    #[Route('/', name: 'app_hide_out_index', methods: ['GET'])]
    public function index(HideOutRepository $hideOutRepository): Response
    {
        return $this->render('hide_out/index.html.twig', [
            'hide_outs' => $hideOutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hide_out_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HideOutRepository $hideOutRepository): Response
    {
        $hideOut = new HideOut();
        $form = $this->createForm(HideOutType::class, $hideOut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hideOutRepository->save($hideOut, true);

            return $this->redirectToRoute('app_hide_out_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hide_out/new.html.twig', [
            'hide_out' => $hideOut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hide_out_show', methods: ['GET'])]
    public function show(HideOut $hideOut): Response
    {
        return $this->render('hide_out/show.html.twig', [
            'hide_out' => $hideOut,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hide_out_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HideOut $hideOut, HideOutRepository $hideOutRepository): Response
    {
        $form = $this->createForm(HideOutType::class, $hideOut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hideOutRepository->save($hideOut, true);

            return $this->redirectToRoute('app_hide_out_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hide_out/edit.html.twig', [
            'hide_out' => $hideOut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hide_out_delete', methods: ['POST'])]
    public function delete(Request $request, HideOut $hideOut, HideOutRepository $hideOutRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hideOut->getId(), $request->request->get('_token'))) {
            $hideOutRepository->remove($hideOut, true);
        }

        return $this->redirectToRoute('app_hide_out_index', [], Response::HTTP_SEE_OTHER);
    }
}
