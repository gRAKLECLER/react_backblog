<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class ArticlesController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $articles = new Articles();

        if ($_COOKIE['userId'] == $this->security->getUser()){
            $articles->setTitle($request->request->get('title'))
                ->setContent($request->request->get('content'))
                ->setUser($_COOKIE[]);


            $entityManager->persist($articles);
            $entityManager->flush();
        }

        return $this->redirectToRoute('');
    }

    public function getAllArticles(ArticlesRepository $articlesRepository): array
    {
        return $articlesRepository->findAll();
    }

}
