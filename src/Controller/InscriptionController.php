<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
     public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, ObjectManager $manager) {
        // build the form
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        // handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password)
                 ->setRoles('user');

            // $cart = new Cart();
            $panier = new Panier();
            $panier->setUser($user);
            $manager->persist($panier);
            $manager->flush();


            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré !');
            return $this->redirectToRoute('login');
        }
        return $this->render('security/registration.html.twig', [
            'controller_name' => 'Inscription',
            'form' => $form->createView(),
            'mainNavRegistration' => true,
            'title' => 'Inscription'
        ]);
    }

    
}
