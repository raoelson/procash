<?php

namespace Procash\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TitreType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('refTitre', 'text', array(
                    'label' => 'Ref.Titre',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Ref.Titre')
                ))
                ->add('nom', 'text', array(
                    'label' => 'Nom',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Nom')
                ))
                ->add('periode', 'text', array(
                    'label' => 'Période',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Période')
                ))
                ->add('quantiteMinimum', 'text', array(
                    'label' => 'Quantité min',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Quantité min')
                ))
                ->add('descriptif', 'text', array(
                    'label' => 'Déscriptif',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Déscriptif')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\AdministrationBundle\Entity\Titre'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'procash_administrationbundle_titre';
    }

}
