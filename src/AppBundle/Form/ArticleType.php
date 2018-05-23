<?php
/**
 * Created by PhpStorm.
 * User: topikana
 * Date: 23/05/18
 * Time: 15:25
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/* take care this part is not finish watch https://openclassrooms.com/courses/construisez-une-api-rest-avec-symfony/la-deserialisation
it's the end of the leson but it's not really logic. It's just an example with Article2Controller */

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('author', AuthorType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }
}