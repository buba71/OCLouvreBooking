<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('guestFirstName', TextType::class, array(
                'label'=>'Prénom',
                'attr' => array('class' => 'prenom')
            ))
            ->add('guestLastName', TextType::class, array(
                'label'=>'Nom',
                'attr' => array('class' => 'Nom')
            ))
            ->add('guestCountry', CountryType::class,array(
                'label'=>'Pays de résidence',
                'attr' => array('class' => 'pays')
            ) )
            ->add('guestBirthDate', DateType::class, array(
                'widget' => 'single_text',
                'label'  => 'Date de naissance',
                'attr'   => array('class', 'Daten'),

            ))
            ->add('discount', CheckboxType::class,array(
                'required' => false,
                'label'    => 'Tarif réduit',
                'attr'     => array('class', 'discount')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Ticket::class
        ]);
    }
}
