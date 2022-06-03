<?php

namespace App\Controller;

use App\Manager\CookieManager;
use App\Manager\TokenManager;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//    private TokenManager $tokenManager;
//
//    private UserRepository $userRepository;
//
//    private CookieManager $cookieManager;
//
//    public function __construct(TokenManager $tokenManager, UserRepository $userRepository, CookieManager $cookieManager)
//    {
//        $this->tokenManager = $tokenManager;
//        $this->userRepository = $userRepository;
//        $this->cookieManager = $cookieManager;
//    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
//        $error = $authenticationUtils->getLastAuthenticationError();
//        // last username entered by the user
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        $user = $this->userRepository->find($lastUsername);
//
//        $token = $this->tokenManager->generateJWT($user);
//        $this->cookieManager->cookieHelper($token);
//
//        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
