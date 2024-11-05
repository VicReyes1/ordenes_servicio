<?php

namespace App\Form;

use App\Entity\Captura;
use App\Entity\Material;
use App\Entity\Salida;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalidaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('precio_salida')
            ->add('fecha')
            ->add('cantidad')
            ->add('Material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'descripcion',
                'choice_value' => 'id', 
                'placeholder' => 'Seleccionar',
            ])
            ->add('captura', EntityType::class, [
                'class' => Captura::class,
                'choice_label' => 'nombre_proyecto',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salida::class,
        ]);
    }
}
