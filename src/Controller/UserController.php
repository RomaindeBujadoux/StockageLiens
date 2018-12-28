<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user_manage", name="user_manage")
     */
    public function user_manage()
    {
    	$em = $this->getDoctrine()->getManager();
    	$users = $em->getRepository(User::class)->findAll();

        return $this->render('usermanage/usermanage.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("admin/del_user/{id}", name="delete_user")
     */ 
    public function del(User $user){
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            return $this->redirectToRoute('user_manage');
    }

    /**
     * @Route("admin/search_user", name="search_user")
     */
    public function recherche(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $motcle = $request->get('motcle');

        //Appelle à la fonction de recherche définie dans le repository
        //en lui passant le mot clé saisi récupéré au-dessus
        $users = $em->getRepository(User::class)->SearchUser($motcle);

        return $this->render('usermanage/usermanage.html.twig', [
            'users' => $users,
        ]);
    }
}