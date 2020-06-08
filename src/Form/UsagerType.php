<?php

namespace App\Form;

use App\Entity\Usager;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;

class UsagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class,array('label' => false,'attr'=>['class'=>'form-control']))
            ->add('password',PasswordType::class,array('label' => false,'attr'=>['class'=>'form-control']))
            ->add('nom',TextType::class,array('label' => false,'attr'=>['class'=>'form-control']))
            ->add('prenom',TextType::class,array('label' => false,'attr'=>['class'=>'form-control']))
            ->add('captchaCode', CaptchaType::class, [
                'captchaConfig' => 'ExampleCaptcha',
                'label' => false,
                'attr'=>['class'=>'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usager::class,
        ]);
    }
}
