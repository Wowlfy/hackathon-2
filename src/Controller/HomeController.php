<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RequestType;
use App\Repository\UserRepository;
use App\Entity\HelpRequest;
use App\Form\HelpRequestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, UserRepository $userRepository): Response

    {
        $helpRequest = new HelpRequest();
        $form = $this->createForm(HelpRequestType::class, $helpRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $helpRequest->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($helpRequest);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        
        $users = $userRepository->findBy([]);
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(), 'users' => $users
        ]);
    }
}
