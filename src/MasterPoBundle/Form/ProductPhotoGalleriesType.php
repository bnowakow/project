<?php

namespace MasterPoBundle\Form;

use Genemu\Bundle\FormBundle\Form\JQuery\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPhotoGalleriesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', FileType::class, [
                'label' => 'Загрузить Фотографии максимум (9 шт.)',
                'multiple' => true,
                'data_class' => null, 'required' => false
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MasterPoBundle\Entity\ProductPhotoGalleries'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'masterpobundle_productphotogalleries';
    }


}
