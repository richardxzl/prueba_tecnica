<?php

namespace AppBundle\Form;

use AppBundle\Entity\Entrada;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EntradaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array("required"=>true, 'attr' => array('class' => 'form-control')))
            ->add('correo', 'email',array("required"=>true, 'attr' => array('class' => 'form-control')))
            ->add('mensaje','textarea',array("required"=>true, 'attr' => array('class' => 'form-control')))
            ->add('Guardar', SubmitType::class, array('attr' => array('class' => 'margen btn btn-primary ')))
        ;
    }/**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Entrada'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entrada';
    }


}
