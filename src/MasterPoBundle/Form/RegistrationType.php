<?php

namespace MasterPoBundle\Form;

use Symfony\Component\Form\AbstractType;

class RegistrationType extends AbstractType
{
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'validation_groups' => array('registration')
        );
    }
}
