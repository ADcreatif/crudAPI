<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login", name="admin_security_login")
     * @param FormFactoryInterface $factory
     * @return Response
     */
    public function login(FormFactoryInterface $factory){

        $form = $factory->createNamed('', LoginType::class);


        return $this->render('security/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/api/login_classic", name="security_login_classic", methods={"POST"})
     */
    public function login_classic()
    {
        $user = $this->getUser();

        return $this->json([
            'user' => $user->getUsername(),
            'roles' => $user->getRoles(),
            'message' => 'Authentication successful'
        ]);
    }

    /**
     * @Route("/api/login_token", name="security_login_token", methods={"POST"})
     */
    public function login_token()
    {
        $user = $this->getUser();

        return $this->json([
            'user' => $user->getUsername(),
            'roles' => $user->getRoles(),
            'message' => 'Authentication successful',
            'token' => 'token-' . $user->getId()
        ]);
    }
}
