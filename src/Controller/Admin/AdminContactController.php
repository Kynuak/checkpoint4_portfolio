<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminContactController extends AbstractController
{
    #[Route('/admin/contact/delete/{idContact}', name: 'app_admin_contact_delete')]
    public function delete(
        #[MapEntity(mapping: ['idContact' => 'id'] )] Contact $contact,
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($this->isCsrfTokenValid((string)('delete'.$contact->getId()), $request->request->get('_token'))) {
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
