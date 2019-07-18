<?php

namespace SoftUniBlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SoftUniBlogBundle\Entity\Article;
use SoftUniBlogBundle\Entity\User;
use SoftUniBlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/article/create", name="article_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
$form->handleRequest($request);
if($form->isSubmitted()){
    $article->setAuthor($this->getUser());
    $em = $this->getDoctrine()->getManager();
    $em->persist($article);
    $em->flush();
    return $this->redirectToRoute('blog_index');
}

    return $this->render('article/create.html.twig',
        array('form' => $form->createView()));
    }

    /**
     * @Route("/article/{id}", name="article_view")
     * @param $id
     * @return Response
     */
    public function viewArticle($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('article/article.html.twig',
            ['article' => $article]);
    }

    /**
     * @Route("/article/edit/{id}", name="article_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function editArticle($id, Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        if($article === null){
            return $this->redirectToRoute('blog_index');
        }
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        /** @var Article $article */
        if(!$currentUser->isAuthor($article) && !$currentUser->isAdmin()){
            return $this->redirectToRoute('blog_index');
        }
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article_view', array('id' => $article->getId()));
        }
        return $this->render('article/edit.html.twig',
            array('article' => $article,
                'form' => $form->createView()));
    }
    /**
     * @Route("/article/delete/{id}", name="article_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function deleteArticle($id, Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        if($article === null){
            return $this->redirectToRoute('blog_index');
        }
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        /** @var Article $article */
        if(!$currentUser->isAuthor($article) && !$currentUser->isAdmin()){
            return $this->redirectToRoute('blog_index');
        }
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
            return $this->redirectToRoute('blog_index');
        }
        return $this->render('article/delete.html.twig',
            array('article' => $article,
                'form' => $form->createView()));
    }
}
