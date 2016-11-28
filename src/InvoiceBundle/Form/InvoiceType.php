<?php

namespace InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use InvoiceBundle\Form\ProductType;
use InvoiceBundle\Form\SubjectType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class InvoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number')
                ->add('generationDate')
                ->add('completionDate')
                ->add('place')
                ->add('comment', TextareaType::class)
                ->add('seller', SubjectType::class)
                ->add('client', SubjectType::class)
                ->add('products', CollectionType::class, [
                    'entry_type' => ProductType::class,
                    'allow_add' => true,
                    'by_reference' => false
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InvoiceBundle\Entity\Invoice'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'invoicebundle_invoice';
    }


}
