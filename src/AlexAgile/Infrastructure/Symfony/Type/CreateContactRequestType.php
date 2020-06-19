<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateContactRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',  TextType::class, [
                'required'   => true,
            ])
            ->add('email', EmailType::class, [
                'required'   => true,
            ])
            ->add('message', TextareaType::class, [
                'required'   => true,
            ])
            ->add('submit', SubmitType::class)
        ;
    }
}
