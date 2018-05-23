<?php
/**
 * Created by PhpStorm.
 * User: topikana
 * Date: 23/05/18
 * Time: 15:37
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/* take care this part is not finish watch https://openclassrooms.com/courses/construisez-une-api-rest-avec-symfony/la-deserialisation
it's the end of the leson but it's not really logic. It's just an example with the two formType
PROBLEM WITH RETURN $this->VIEW()*/

class Article2Controller extends Controller

{
    /**
     * @Rest\Post(
     *    path = "/articles",
     *    name = "app_article2_create"
     * )
     * @Rest\View(StatusCode = 201)
     */
    public function createAction()
    {
        $data = $this->get('jms_serializer')->deserialize($request->getContent(), 'array', 'json');
        $article = new Article();
        $form = $this->get('form.factory')->create(ArticleType::class, $article);
        $form->submit($data);

        $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();

        return $this->render($article, Response::HTTP_CREATED, ['Location' => $this->generateUrl('app_article2_create',
            ['id' => $article->getId()])]);
    }
}