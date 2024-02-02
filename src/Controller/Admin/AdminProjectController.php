<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProjectController extends AbstractController
{
    #[Route('/admin/project/new', name: 'app_admin_project_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {

        $projet = new Project();
        $formNewProject = $this->createForm(ProjetType::class, $projet);
        $formNewProject->handleRequest($request);

        if($formNewProject->isSubmitted() && $formNewProject->isValid()) {
            $entityManager->persist($projet);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/projects/new.html.twig', [
            'formNewProject' => $formNewProject,
        ]);
    }

    #[Route('/admin/projects/edit/{idProject}', name: 'app_admin_projects_edit')]
    public function edit(
        #[MapEntity(mapping: ['idProject' => 'id'])] Project $project,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $formNewProject = $this->createForm(ProjetType::class, $project);
        $formNewProject->handleRequest($request);

        if($formNewProject->isSubmitted() && $formNewProject->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/projects/edit.html.twig',[
            'formNewProject' => $formNewProject,
        ]);
    }

    #[Route('/admin/projects/delete/{idProject}', name: 'app_admin_projects_delete', methods: ['POST'])]
    public function delete(
        #[MapEntity(mapping: ['idProject' => 'id'])] Project $project,
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($this->isCsrfTokenValid((string)('delete'.$project->getId()), $request->request->get('_token'))) {
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
