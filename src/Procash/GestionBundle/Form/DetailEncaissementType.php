<?php

namespace Procash\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DetailEncaissementType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('numeroFacture', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Num.Facture')
                ))
                ->add('date', 'date', array(
                    'required' => true,
                    'widget' => 'single_text',
                    'label' => 'Date fermeture',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'placeholder' => 'Date de fermeture'
            )))
                ->add('montantFacture', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Montant Facture')
                ))
                ->add('montantDu', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Montant du')
                ))
                ->add('montantPaye', 'text', array(
                    'label' => '',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Montant paye')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\GestionBundle\Entity\DetailEncaissement'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'procash_gestionbundle_detailencaissement';
    }

}
