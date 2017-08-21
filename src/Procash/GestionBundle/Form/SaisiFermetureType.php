<?php

namespace Procash\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Procash\AdministrationBundle\Entity\MotifFermetureRepository;

class SaisiFermetureType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateDebutFermeture', 'date', array(
                    'required' => true,
                    'widget' => 'single_text',
                    'label' => 'Date début fermeture',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'placeholder' => 'Date de fermeture'
            )))
                ->add('dateFinFermeture', 'date', array(
                    'required' => true,
                    'widget' => 'single_text',
                    'label' => 'Date fin fermeture',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'placeholder' => 'Date de fermeture'
            )))
                ->add('client', 'entity', array(
                    'label' => 'Client',
                    'attr' => array(
                        'class' => 'col-sm-3 form-control'),
                    'class' => 'ProcashAdministrationBundle:Client',
                    'property' => 'nom',
                    'multiple' => false,
                    'required' => true,
//                    'empty_value' => '',
                ))
                ->add('motifFermeture', 'entity', array(
                    'label' => 'Motif',
                    'attr' => array(
                        'class' => 'col-sm-3 form-control'),
                    'class' => 'ProcashAdministrationBundle:MotifFermeture',
                    'property' => 'libelle',
                    'multiple' => false,
                    'required' => true,
//                    'empty_value' => '',
                    'query_builder' => function(MotifFermetureRepository $er ) {
                return $er->createQueryBuilder('w')
                        ->where('w.dateSuppression is null');
            }
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\GestionBundle\Entity\SaisiFermeture'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'procash_gestionbundle_saisifermeture';
    }

}
