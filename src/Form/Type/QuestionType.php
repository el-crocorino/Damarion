<?php

namespace Damarion\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('game_id', 'text')
            ->add('text', 'text')
            ->add('order', 'text')
            ->add('active', 'checkbox', array(
                'label' => 'Active ?',
                'required' => false
            ))
            ->add('hasPictureAfter', 'checkbox', array(
                'label' => 'Afficher question après ?',
                'required' => false
            ));

    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Damarion\Domain\Question');
    }

    public function getName() {
        return 'question';
    }

}
