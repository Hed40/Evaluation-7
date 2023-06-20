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

#[Route('/missions')]
class MissionsController extends AbstractController
{
    #[Route('/', name: 'app_missions_index', methods: ['GET'])]
    public function index(MissionsRepository $missionsRepository): Response
{

        return $this->render('missions/index.html.twig', [
            'missions' => $missionsRepository->findAll(),
            
        ]);
    }

    #[Route('/missions/{status}', name: 'app_missions_by_status', methods: ['GET'])]
    public function getMissionsByStatus(Request $request, MissionsRepository $missionsRepository, string $status): JsonResponse
    {
        // Récupérer les missions en fonction du statut
        $missions = $missionsRepository->findBy(['status' => $status]);
    
        // Si aucune mission n'est trouvée, on renvoie une erreur 404
        if (!$missions) {
            throw $this->createNotFoundException(
                'No missions found for status '.$status
            );
        }
    
        // Tableau pour stocker les données des missions
        $missionData = [];
    
        // Parcourir chaque mission et extraire les données nécessaires
        foreach ($missions as $mission) {
            $missionData[] = [
                'Status' => $mission->getStatus(),
                'Titre' => $mission->getTitle(),
                'Description' => $mission->getDescription(),
                'CodeName' => $mission->getCodeName(),
            ];
        }
    
        // Renvoyer les missions en tant que réponse JSON
        return new JsonResponse([
            'missions' => $missionData,
        ]);
    }
    

    #[Route('/{id}', name: 'app_missions_show', methods: ['GET'])]
public function show(Missions $mission): Response
{

    return $this->render('missions/show.html.twig', [
        'mission' => $mission,
    
    ]);
}

    #[Route('/new', name: 'app_missions_new', methods: ['GET', 'POST'])]
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
        if ($this->isCsrfTokenValid('delete'.$mission->getId(), $request->request->get('_token'))) {
            $missionsRepository->remove($mission, true);
        }

        return $this->redirectToRoute('app_missions_index', [], Response::HTTP_SEE_OTHER);
    }
}
