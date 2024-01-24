<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Livres;
use App\Repository\LivresRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/', name: 'app_home')]
    public function index(LivresRepository $livresRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $livres = $paginator->paginate(
            $livresRepository->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            18
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'livres' => $livres,
        ]);
    }
}
