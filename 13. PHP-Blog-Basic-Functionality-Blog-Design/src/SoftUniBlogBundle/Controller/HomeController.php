<?php

namespace SoftUniBlogBundle\Controller;

use SoftUniBlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     *
     * @return Response
     */
    public function indexAction()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('default/index.html.twig', [
            'articles' => $articles
        ]);
    }

}
