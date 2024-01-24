<?php

namespace App\Controller\Admin;

use App\Entity\Livres;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class LivresCrudController extends AbstractCrudController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Livres::class;
    }
    public function configureFields(string $pageName): iterable
    {
        $users = [];
        foreach ($this->userRepository->findAll() as $user) {
            $users[$user->getPrenom()] = $user;
        }

        return [
            IdField::new('id')
            ->hideOnIndex(),
            TextField::new('titre'),
            ImageField::new('image')
                ->setBasePath('/uploads/livres_images')
                ->setUploadDir('public/uploads/livres_images')
                ->setRequired(false),
            TextField::new('editeur'),
            TextField::new('auteur'),
            IntegerField::new('isbn'),
            DateField::new('date_publication')
                ->setLabel('Date de publication')
                ->setFormat('dd-MM-yyyy'),
            TextField::new('resume'),
            AssociationField::new('genre'),
            ChoiceField::new('empruntePar')
                ->setChoices($users)
                ->setLabel('Emprunteur'),
        ];
    }
}
