<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('password'),
            DateField::new('created_at')
            ->setRequired(true),
            TextField::new('nom'),
            TextField::new('prenom')
            ->setRequired(true),
            IntegerField::new('telephone'),
            ImageField::new('imageprofil')
            ->setLabel('Image de profil')
            ->setBasePath('/uploads/profile_images')
            ->setUploadDir('public/uploads/profile_images')
            ->setRequired(false)
            ->setRequired(true),
        ];
    }
}
