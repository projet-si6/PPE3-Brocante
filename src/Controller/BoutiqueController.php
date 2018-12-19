<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{
    /**
     * @Route("/boutique", name="boutique")
     */
    public function index()
    {
        return $this->render('boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('boutique/home.html.twig');
    }

    /**
     * @Route("/Administration", name="administration")
     */
    public function admin()
    {
        return $this->render('./administration/home.html.twig');
    }

    /**
     * @Route("/produits", name="produits")
     */
    public function produits()
    {
        return $this->render('boutique/NosProduits.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(){
        return $this->render('boutique/Contact.html.twig');
    }
}
