<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index()
    {
        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }

     /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('./boutique/home.html.twig');
    }

    /**
     * @Route("/newCat", name="NewCategorie")
     */
    public function CreerCategorie( Request $request, ObjectManager $manager)
    {
        $categorie = new Categorie();
        
        $form = $this->createFormBuilder($categorie)
                    ->add('titre', TextType::class)
                    ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $categorie->setTitre();

            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('./boutique/NosProduits.html.twig');
        }

        return $this->render('administration/newCategorie.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/newArticle", name="NewArticle")
     */
    public function NewArticle()
    {

        

        return $this->render('administration/newArticle.html.twig');
    }
}
