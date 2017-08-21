<?php

namespace Procash\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BanqueType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('codeInterne', 'text', array(
                    'label' => 'code interne',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'code interne')
                ))
                ->add('libelle', 'text', array(
                    'label' => 'Libelle',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Libelle')
                ))
                ->add('refExterne', 'text', array(
                    'label' => 'Ref.Externe',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Ref.Externe')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\AdministrationBundle\Entity\Banque'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'procash_administrationbundle_banque';
    }

}
