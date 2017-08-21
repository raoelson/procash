<?php

namespace Procash\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfilType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('libelle');
        $builder->add('code', 'choice', array(
            'choices' => array(
                'adm' => 'adm',
                'col' => 'col',
                'ges' => 'ges',
                'ope' => 'ope',
            ),
            'multiple' => false,
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\AdministrationBundle\Entity\Profil'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'procash_administrationbundle_profil';
    }

}
