<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Form\AgentsType;
use App\Repository\AgentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agents')]
class AgentsController extends AbstractController
{
    #[Route('/', name: 'app_agents_index', methods: ['GET'])]
    public function index(AgentsRepository $agentsRepository): Response
    {
        return $this->render('agents/index.html.twig', [
            'agent' => $agentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_agents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AgentsRepository $agentsRepository): Response
    {
        $agents = new Agents();
        $form = $this->createForm(AgentsType::class, $agents);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agentsRepository->save($agents, true);

            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/new.html.twig', [
            'agent' => $agents,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_show', methods: ['GET'])]
    public function show(Agents $agents): Response
    {
        return $this->render('agents/show.html.twig', [
            'agent' => $agents,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_agents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agents $agents, AgentsRepository $agentsRepository): Response
    {
        $form = $this->createForm(AgentsType::class, $agents);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agentsRepository->save($agents, true);

            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/edit.html.twig', [
            'agent' => $agents,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_delete', methods: ['POST'])]
    public function delete(Request $request, Agents $agents, AgentsRepository $agentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agents->getId(), $request->request->get('_token'))) {
            $agentsRepository->remove($agents, true);
        }

        return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
    }
}
