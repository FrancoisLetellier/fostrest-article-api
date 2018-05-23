<?php
/**
 * Created by PhpStorm.
 * User: topikana
 * Date: 22/05/18
 * Time: 17:18
 */

namespace AppBundle\Controller;




use AppBundle\Entity\Article;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends FOSRestController
{
    /**
     * @Get(
     *     path = "/articles/{id}",
     *     name = "app_article_show",
     *     requirements= {"id"="\d+"}
     * )
     * @View
     */
    public function showAction()
    {
        $article = new Article();
        $article->setTitle('Pourquoi tu fais ça');
        $article->setContent('On raconte de la dope');

        return $article;
    }

    /**
     * @Post(
     *     path = "/articles",
     *     name = "app_article_create"
     * )
     * @Rest\View(StatusCode=201)
     * @ParamConverter("article", converter="fos_rest.request_body" )
     */
    public function createAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->view(
            $article,
            Response::HTTP_CREATED,
            ['Location' => $this->generateUrl
        ('app_article_create', ['id' => $article->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    }

}