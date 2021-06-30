<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\HelpRequest;
use App\Form\HelpRequestType;
use App\Repository\HelpRequestRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, UserRepository $userRepository, HelpRequestRepository $helpers): Response
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

        $helpRequests = $this->getDoctrine()
        ->getRepository(HelpRequest::class)
        ->findAll();

        $owner = $this->getUser()->getHelpRequests();
        //dd($owner);
        

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'helpRequests' => $helpRequests,
            'users' => $users,
            'owner' => $owner
        ]);
    }

    /**
     * @Route("/help/{id}", name="help")
     */
    public function help(?int $id, HelpRequestRepository $helpRequestRepository): Response
    {
        $user = $this->getUser();
        
        $helpRequest = $helpRequestRepository->findOneby(['id' => $id]);
        
        $helpRequest->addHelper($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($helpRequest);
        $entityManager->flush();
        
        $helpers = $helpRequest->getHelpers();

        return $this->redirectToRoute('home', [
            'helpers' => $helpers,
        ]);
    }
    

    
}
