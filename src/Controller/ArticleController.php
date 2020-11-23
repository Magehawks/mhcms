<?php


namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/create", name="app_article_new")
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, SluggerInterface $slugger)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted()  &&  $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $article->setName($form->get('name')->getData());
            $article->setInStock($form->get('price')->getData());
            $article->setInStock($form->get('instock')->getData());
            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($article);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            // ... persist the $product variable or any other work

          //  return $this->redirectToRoute('app_product_list');
        }
        return $this->render('Article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}