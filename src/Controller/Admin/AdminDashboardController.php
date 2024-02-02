<?php

namespace App\Controller\Admin;

use App\Repository\ContactRepository;
use App\Repository\HardSkillRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(
        HardSkillRepository $hardSkillRepository,
        ProjectRepository $projectRepository,
        ContactRepository $contactRepository
    ): Response
    {

        $hardSkills = $hardSkillRepository->findAll();
        $projects = $projectRepository->findAll();
        $contacts = $contactRepository->findAll();
        return $this->render('admin/dashboard.html.twig', [
            'hardSkills' => $hardSkills,
            'projects' => $projects,
            'contacts' => $contacts
        ]);
    }
}
