<?php

namespace App\Form;

use App\Entity\Departamento;
use App\Entity\Empleado;
use App\Entity\Puesto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('email')
            ->add('telefono')
            ->add('fechaIngreso', null, [
                'widget' => 'single_text',
            ])
            ->add('salario')
            ->add('comision')
            ->add('puesto', EntityType::class, [
                'class' => Puesto::class,
                'choice_label' => 'id',
            ])
            ->add('jefe', EntityType::class, [
                'class' => Empleado::class,
                'choice_label' => 'id',
            ])
            ->add('departamento', EntityType::class, [
                'class' => Departamento::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empleado::class,
        ]);
    }
}
