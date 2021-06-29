<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Request;
use App\Form\RequestType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $user = new User();
        //$user = $this->getUser()->getUsername();

        $request = new Request();
        $form = $this->createForm(RequestType::class, $request);

        if ($form->isSubmitted() && $form->isValid()) {
            $request->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($request);
            $entityManager->flush();
        }

        //dd($user);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
