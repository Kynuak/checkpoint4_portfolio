<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private const LINK_RESEAUX = [
        "github" => "https://github.com/Kynuak",
        "linkedin" => "https://www.linkedin.com/in/baptiste-trouille-518483a8/",
    ];

    #[Route('/', name: 'app_home')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy([]);
        return $this->render('home/index.html.twig', [
            'user' => $user,
            'linkReseau' => self::LINK_RESEAUX
        ]);
    }
}
 