<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\Authenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, Authenticator $authenticator, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $created = new \DateTimeImmutable();
            $user->setCreatedAt($created);

            if ($form->isSubmitted() && $form->isValid()) {

                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );

                $profileImage = $form->get('imageprofil')->getData();

                $oldFilename = $user->getImageprofil();

                if ($profileImage) {
                    $originalFilename = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $profileImage->guessExtension();

                    $profileImage->move(
                        $this->getParameter('profile_image_directory'),
                        $newFilename
                    );

                    if ($oldFilename) {
                        unlink($this->getParameter('profile_image_directory') . '/' . $oldFilename);
                    }

                    $user->setImageprofil($newFilename);
                }

                $entityManager->persist($user);
                $entityManager->flush();

                $user->setRoles(['ROLE_USER']);
                $entityManager->flush();

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            } else {
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                    'passError' => 'Les mots de pass ne sont pas identiques'
                ]);
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
