<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Links;
use App\Repository\LinksRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\AddLinkType;

class LinksController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
    	$em = $this->getDoctrine()->getManager();
    	$links = $em->getRepository(Links::class)->findAll();

        return $this->render('links/index.html.twig', [
            'links' => $links,
        ]);
    }

    /**
     * @Route("/view/{id}", name="view")
     */
    public function view(Links $link)
    {
        return $this->render('links/view.html.twig', [
            'link' => $link,
        ]);
    }

    /**
     * @Route("/add", name="add")
     */ 
    public function add(Request $request){
        $link = new Links();

        //On préremplit le champ 'auteur' avec le pseudo utilisateur
        $auteur = $this->getUser()->getUsername();
        $link->setAuteur($auteur);

        //De même pour la date de publication avec la date courante
        $date_publi = $this->DatePubli = new \DateTime('now');
        $link->setDatePubli($date_publi);

        $form = $this->createForm(AddLinkType::class, $link);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('links/add.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */ 
    public function edit(Links $link, Request $request){
        $form = $this->createForm(AddLinkType::class, $link);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('links/add.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }

    /**
     * @Route("/del/{id}", name="delete")
     */ 
    public function del(Links $link){
            $em = $this->getDoctrine()->getManager();
            $em->remove($link);
            $em->flush();

            return $this->redirectToRoute('home');
    }

    /**
     * @Route("/search", name="search")
     */
    public function recherche(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $motcle = $request->get('motcle');

        $links = $em->getRepository(Links::class)->findBy( ['Nom' => $motcle]);

        return $this->render('links/index.html.twig', [
            'links' => $links,
        ]);
    }
}
