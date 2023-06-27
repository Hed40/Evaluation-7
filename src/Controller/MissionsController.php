<?php

namespace App\Controller;

use App\Entity\Missions;
use App\Form\MissionsType;
use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/missions')]
#[IsGranted('ROLE_ADMIN')]
class MissionsController extends AbstractController
{
    #[Route('/', name: 'app_missions_index', methods: ['GET'])]
    public function index(MissionsRepository $missionsRepository): Response
    {

        return $this->render('missions/index.html.twig', [
            'missions' => $missionsRepository->findAll(),

        ]);
    }
    #[Route('/', name: 'app_missions_show', methods: ['GET'])]
    public function show(Missions $mission): Response
    {

        return $this->render('missions/show.html.twig', [
            'mission' => $mission,

        ]);
    }

    #[Route('/creat/new', name: 'app_missions_creat_new', methods: ['GET', 'POST'])]

    public function new(Request $request, MissionsRepository $missionsRepository): Response
    {
        $mission = new Missions();
        $form = $this->createForm(MissionsType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionsRepository->save($mission, true);

            return $this->redirectToRoute('app_missions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('missions/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_missions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Missions $mission, MissionsRepository $missionsRepository): Response
    {
        $form = $this->createForm(MissionsType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionsRepository->save($mission, true);

            return $this->redirectToRoute('app_missions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('missions/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_missions_delete', methods: ['POST'])]
    public function delete(Request $request, Missions $mission, MissionsRepository $missionsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mission->getId(), $request->request->get('_token'))) {
            $missionsRepository->remove($mission, true);
        }

        return $this->redirectToRoute('app_missions_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
