<?php

namespace App\Controller;

use App\Entity\Kategoria;
use App\Entity\Produkt;
use App\Form\KategoriaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {
        //List of produkt show on start
        $em = $this->getDoctrine()->getManager();
        $produkty = $em->getRepository(Produkt::class)->findAll();

        //Create form to search according kategoria
        $form = $this->createForm(KategoriaType::class);
        //Catch request from form(KategoriaType)
        $form->handleRequest($request);

        //Check if form(KategoriaType) was Submitted and is Valid
        if($form->isSubmitted() && $form->isValid()){

            //Get Kategoria that should be shown
            $nazwa_included = $form->get('nazwa_included')->getData();
            //Get Kategoria that should not be shown
            $nazwa_exclude = $form->get('nazwa_exclude')->getData();

            //Method: findByKategoria
            //Created in: ProduktRepository
            //Method show produkt according received values and send result to $produkty
            $produkty = $em->getRepository(Produkt::class)->findByKategoria($nazwa_included, $nazwa_exclude);
        }

        
        return $this->render('index/index.html.twig', [
            'produkty' => $produkty,
            'form' => $form->createView(),
        ]);
    }
}
