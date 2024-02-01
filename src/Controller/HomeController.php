<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\CategoryRepository;
use App\Repository\HardSkillRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private const LINK_RESEAUX = [
        "github" => "https://github.com/Kynuak",
        "linkedin" => "https://www.linkedin.com/in/baptiste-trouille-518483a8/",
    ];

    #[Route('/', name: 'app_home')]
    public function index(
        UserRepository $userRepository,
        CategoryRepository $categoryRepository,
        ProjectRepository $projectRepository,
        Request $request
    ): Response
    {
        $user = $userRepository->findOneBy([]);
        $categories = $categoryRepository->findAll();
        $projets = $projectRepository->findAll();

        $contact = new Contact();
        
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()) {

        }


        return $this->render('home/index.html.twig', [
            'user' => $user,
            'linkReseau' => self::LINK_RESEAUX,
            'categories' => $categories,
            'projets' => $projets,
            'formContact' => $formContact
        ]);
    }
}
