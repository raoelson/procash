<?php

namespace Procash\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncaissementType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('montant', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))
                ->add('numeroRecu', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))
                ->add('banque', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))
                ->add('numeroCheque', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))
                ->add('numeroRecu', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))
                ->add('echeance', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\GestionBundle\Entity\Encaissement'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'procash_gestionbundle_encaissement';
    }

}
