<?php

namespace App\Form;

use App\Entity\Captura;
use App\Entity\Entrada;
use App\Entity\Material;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class EntradaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('precio_adquirido')
            ->add('fecha')
            ->add('Material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'nombre',
                'choice_value' => 'id', 
                'placeholder' => 'Seleccionar',
            ])
            ->add('cantidad')

            ;
            }       
function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
