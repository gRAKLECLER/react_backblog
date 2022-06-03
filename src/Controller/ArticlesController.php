<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ArticlesController extends AbstractController
{
    private $entityManager;
    private $security;
    private $articlesRepository;
    private $userRepository;

    public function  __construct(EntityManagerInterface $entityManager, Security $security, ArticlesRepository $articlesRepository,
                                 UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->articlesRepository = $articlesRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @Route("/api/create_article", name="app_api_create")
     */
    public function create(Request $request): void
    {
        $data = json_decode($request->getContent(), true);

        $tokenParts = explode(".", $data['token']);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);
        $username = $jwtPayload->username;

        $user = $this->userRepository->findBy(['email' => $username]);

        $post = new Articles();

        $post->setTitle($data['title'])
            ->setContent($data['content'])
            ->setUser($user[0]);

        try {
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            echo 'success';
            die;
        } catch (ORMException $e) {  echo $e;
        }
    }


    /**
     * @param Request $request
     * @return Articles[]
     * @Route("/api/articles", name="app_articles")
     */
    public function getAll(Request $request) {
        return $this->articlesRepository->findAll();
    }

}
