<?php

namespace App\Form;

use App\Entity\Pais;
use App\Entity\Provincia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProvinciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('pais', EntityType::class, [
                'class' => Pais::class,
                'choice_label' => 'id',
            ])
            ->add('poblacion', IntegerType::class, [ 
            'required' => false, 
            'label' => 'Población', 
            ]) 
            ->add('superficie', NumberType::class, [ 
            'required' => false, 
            'label' => 'Superficie', 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Provincia::class,
        ]);
    }
}
