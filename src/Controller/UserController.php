<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private $entityManager;
    private $hasher;

    public function  __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher)
    {
        $this->entityManager = $entityManager;
        $this->hasher = $hasher;
    }

    /**
     * @param Request $request
     * @throws \JsonException
     * @Route("/api/register", name="app_api_register")
     */
    public function Register(Request $request): void
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $user = new User();
        $user->setEmail($data['email'])
            ->setPassword($this->hasher->hashPassword($user, $data['password']));

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            echo 'success';
            die;
        } catch (ORMException $e) {
            echo $e;
        }
    }

}
