<?php

namespace Jmn\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParamTypeEdit extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',null,array('required'=>false,'attr'=>array('size'=>30)))
            ->add('name',null,array('attr'=>array('required'=>true,'size'=>30)))
			->add('unit',null,array('required'=>false,'attr'=>array('size'=>30)))
            ->add('value',null,array('required'=>true,'attr'=>array('size'=>30)))
        ;
    }   
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jmn\ProductBundle\Entity\Param'
        ));
    }
}
