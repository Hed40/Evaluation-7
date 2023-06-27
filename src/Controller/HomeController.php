<?php

namespace App\Controller;

use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(MissionsRepository $missionsRepository): Response
    {

        $missions = $missionsRepository->findAll();

        return $this->render('home/index.html.twig', [
            'missions' => $missions,
        ]);
    }

    #[Route('/{statut}', name: 'app_home_missions_by_statut', methods: ['GET'])]
    public function getMissionsByStatut(Request $request, MissionsRepository $missionsRepository, string $statut): JsonResponse
    {
        // Récupérer les missions en fonction du statut
        $missions = $missionsRepository->findBy(['statut' => $statut]);
    
        // Si aucune mission n'est trouvée, on renvoie une erreur 404
        if (!$missions) {
            throw $this->createNotFoundException(
                'No missions found for statut '.$statut
            );
        }
    
        // Tableau pour stocker les données des missions
        $missionData = [];
    
        // Parcourir chaque mission et extraire les données nécessaires
        foreach ($missions as $mission) {
            $missionData[] = [
                'Statut' => $mission->getStatut(),
                'Titre' => $mission->getTitle(),
                'Description' => $mission->getDescription(),
                'CodeName' => $mission->getCodeName(),
                'StartDate' => $mission->getStartDate()->format('d-m-Y'),
                'EndDate' => $mission->getEndDate()->format('d-m-Y'),
                'Pays' => $mission->getCountry(),
                'Spécialité' => $mission->getRequiredSpeciality(),
                'Agents' => $mission->getAgents()->map(fn($agent) => $agent->getFirstName())->toArray(),
                'Contacts' => $mission->getContacts()->map(fn($contacts) => $contacts->getFirstName())->toArray(),
            ];
        }
    
        // Renvoyer les missions en tant que réponse JSON
        return new JsonResponse([
            'missions' => $missionData,

        ]);
    }
    

}
