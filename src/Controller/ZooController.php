<?php

namespace App\Controller;

use App\Entity\Zoo;
use App\Form\ZooType;
use App\Repository\ZooRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/zoo')]
final class ZooController extends AbstractController
{
    #[Route(name: 'app_zoo_index', methods: ['GET'])]
    public function index(ZooRepository $zooRepository): Response
    {
        return $this->render('zoo/index.html.twig', [
            'zoos' => $zooRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_zoo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zoo = new Zoo();
        $form = $this->createForm(ZooType::class, $zoo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zoo);
            $entityManager->flush();

            return $this->redirectToRoute('app_zoo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zoo/new.html.twig', [
            'zoo' => $zoo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zoo_show', methods: ['GET'])]
    public function show(Zoo $zoo): Response
    {
        return $this->render('zoo/show.html.twig', [
            'zoo' => $zoo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_zoo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Zoo $zoo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZooType::class, $zoo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_zoo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zoo/edit.html.twig', [
            'zoo' => $zoo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zoo_delete', methods: ['POST'])]
    public function delete(Request $request, Zoo $zoo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zoo->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($zoo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_zoo_index', [], Response::HTTP_SEE_OTHER);
    }
}
