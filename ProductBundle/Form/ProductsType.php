<?php

namespace Jmn\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null,array('required'=>true,'attr'=>array('size'=>30)))
	->add('description',TextareaType::class,array('required'=>true,'attr'=>array('cols'=>66,'rows'=>4)))
	->add('price',null,array('required'=>true,'attr'=>array('size'=>30)));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jmn\ProductBundle\Entity\Products'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jmn_productbundle_products';
    }


}
