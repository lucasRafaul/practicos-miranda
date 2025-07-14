<?php

namespace App\Form;

use App\Entity\Departamento;
use App\Entity\Empleado;
use App\Entity\Ubicacion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('ubicacion', EntityType::class, [
                'class' => Ubicacion::class,
                'choice_label' => 'id',
            ])
            ->add('jefe', EntityType::class, [
                'class' => Empleado::class,
                'choice_label' => 'id',
            ])
            ->add('empleados', CollectionType::class, [
                'entry_type' => EmpleadoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Departamento::class,
        ]);
    }
}
