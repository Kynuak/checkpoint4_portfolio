<?php

namespace App\Controller\Admin;

use App\Entity\HardSkill;
use App\Form\HardSkillsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHardSkillsController extends AbstractController
{
    #[Route('/admin/skills/new', name: 'app_admin_skills_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager    
    ): Response
    {
        $hardSkill = new HardSkill();
        $formNewHardSkills = $this->createForm(HardSkillsType::class, $hardSkill);
        $formNewHardSkills->handleRequest($request);

        if($formNewHardSkills->isSubmitted() && $formNewHardSkills->isValid()) {
            $entityManager->persist($hardSkill);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/hardSkills/new.html.twig', [
            'formNewHardSkill' => $formNewHardSkills,
        ]);
    }

    #[Route('/admin/skills/edit/{idHardSkill}', name: 'app_admin_skills_edit')]
    public function edit(
        #[MapEntity(mapping: ['idHardSkill' => 'id'])] HardSkill $hardSkill,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $formNewHardSkills = $this->createForm(HardSkillsType::class, $hardSkill);
        $formNewHardSkills->handleRequest($request);

        if($formNewHardSkills->isSubmitted() && $formNewHardSkills->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/hardSkills/edit.html.twig',[
            'formNewHardSkill' => $formNewHardSkills,
        ]);
    }

    #[Route('/admin/skills/delete/{idHardSkill}', name: 'app_admin_skills_delete', methods: ['POST'])]
    public function delete(
        #[MapEntity(mapping: ['idHardSkill' => 'id'])] HardSkill $hardSkill,
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($this->isCsrfTokenValid((string)('delete'.$hardSkill->getId()), $request->request->get('_token'))) {
            $entityManager->remove($hardSkill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
