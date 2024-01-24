<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Livres;

class LivreController extends AbstractController
{
    #[Route('/emprunter/{id}', name: 'emprunter_livre')]
    public function emprunterLivre(Livres $livre, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        if (!$livre->isEmprunte() && $user !== null) {
            $livre->setEmprunte(true);
            $livre->setEmpruntePar($user);
            $livre->setDateRendu(new \DateTime('+30 days'));

            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Livre emprunté avec succès!');
        } elseif ($user === null) {
            $this->addFlash('danger', 'Vous devez être connecté pour emprunter un livre.');
        } else {
            $this->addFlash('danger', 'Le livre est déjà emprunté.');
        }

        return $this->redirectToRoute('app_home');
    }
    #[Route('/rendre/{id}', name: 'rendre_livre')]
    public function rendreLivre(Livres $livre, ManagerRegistry $doctrine): Response
    {
        if ($livre->isEmprunte()) {
            $livre->setEmprunte(false);
            $livre->setEmpruntePar(null); 

            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Livre rendu avec succès!');
        } else {
            $this->addFlash('danger', 'Le livre n\'est pas emprunté.');
        }

        return $this->redirectToRoute('app_home');
    }
}
