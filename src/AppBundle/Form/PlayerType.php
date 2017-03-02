<?php
/**
 * Created by PhpStorm.
 * User: alexandraduval
 * Date: 02/03/2017
 * Time: 15:34
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class PlayerType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('rawPassword', PasswordType::class, ['label' => 'Password'])
            ->add('Register', SubmitType::class)
        ;
    }
}