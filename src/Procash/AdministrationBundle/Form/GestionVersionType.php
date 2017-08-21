<?php

namespace Procash\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GestionVersionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('version','choice', array(
                    'label' => ' ',
                    'choices' => array(0 => 'Version majeure ', 1 => ' Version mineur ',2 => ' Révision'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true
                ))
            ->add('file','file',array('label' => ' ','attr' =>array('class'=>''),'required' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Procash\AdministrationBundle\Entity\GestionVersion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'procash_administrationbundle_gestionversion';
    }
}
