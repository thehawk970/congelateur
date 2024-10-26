<?php

namespace App\UXTable;

use App\Entity\Food;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WeDevelop\UXTable\Table\AbstractTable;

final class FoodTable extends AbstractTable
{
    public function getName(): string
    {
        return 'food';
    }

    protected function buildFilterForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', SearchType::class, [
                'attr' => $this->stimulusSearchAttributes(),
                'required' => false,
            ]);
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => Food::class,
            'sortable_fields' => ['label'],
        ]);
    }
}