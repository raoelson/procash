<?php

namespace Procash\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DelaiFermetureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('delaiMin', 'integer', array(
                    'label' => 'Délai min',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
            ->add('seuilMax', 'integer', array(
                    'required' => true,
                    'attr' => array('class' => 'form-control'),
                ))
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\AdministrationBundle\Entity\DelaiFermeture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'procash_administrationbundle_delaifermeture';
    }
}
