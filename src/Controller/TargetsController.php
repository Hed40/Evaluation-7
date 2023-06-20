<?php

namespace App\Controller;

use App\Entity\Targets;
use App\Form\TargetsType;
use App\Repository\TargetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/targets')]
class TargetsController extends AbstractController
{
    #[Route('/', name: 'app_targets_index', methods: ['GET'])]
    public function index(TargetsRepository $targetsRepository): Response
    {
        return $this->render('targets/index.html.twig', [
            'targets' => $targetsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_targets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TargetsRepository $targetsRepository): Response
    {
        $target = new Targets();
        $form = $this->createForm(TargetsType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $targetsRepository->save($target, true);

            return $this->redirectToRoute('app_targets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('targets/new.html.twig', [
            'target' => $target,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_targets_show', methods: ['GET'])]
    public function show(Targets $target): Response
    {
        return $this->render('targets/show.html.twig', [
            'target' => $target,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_targets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Targets $target, TargetsRepository $targetsRepository): Response
    {
        $form = $this->createForm(TargetsType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $targetsRepository->save($target, true);

            return $this->redirectToRoute('app_targets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('targets/edit.html.twig', [
            'target' => $target,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_targets_delete', methods: ['POST'])]
    public function delete(Request $request, Targets $target, TargetsRepository $targetsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$target->getId(), $request->request->get('_token'))) {
            $targetsRepository->remove($target, true);
        }

        return $this->redirectToRoute('app_targets_index', [], Response::HTTP_SEE_OTHER);
    }
}
