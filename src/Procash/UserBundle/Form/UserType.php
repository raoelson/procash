<?php

namespace Procash\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', 'text', array(
                    'label' => 'Nom',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Nom')
                ))
                ->add('prenom', 'text', array(
                    'label' => 'Prenom',
                    'required' => true,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Prenom')
                ))
                ->add('profil', 'entity', array(
                    'label' => 'Rôle',
                    'attr' => array(
                        'class' => 'col-sm-3 form-control select2 input-sm'),
                    'class' => 'ProcashAdministrationBundle:Profil',
                    'property' => 'libelle',
                    'empty_value' => 'Choisir un rôle...',
                    'multiple' => false
                ))
                ->add('telephone', 'text', array(
                    'label' => 'Telephone',
                    'required' => false,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Telephone')
                ))
                ->add('telephonePortable', 'text', array(
                    'label' => 'Mobile',
                    'required' => false,
                    'attr' => array(
                        'class' => 'col-sm-3 form-control input-sm',
                        'placeholder' => 'Téléphone portable')
                ))
                
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'procash_user_registration';
    }

}
