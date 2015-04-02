<?php

namespace Damarion\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AnswerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('question_id', 'choice', array(
                'choices' => $options['data'],
                'expanded' => false,
                'multiple' => false
            ))
            ->add('text', 'text')
            ->add('right', 'checkbox', array(
                'label' => 'Bonne réponse ? ',
                'required' => false
            ))
            ->add('active', 'checkbox', array(
                'label' => 'Active ?',
                'required' => false
            ));
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Damarion\Domain\Answer');
    }

    public function getName() {
        return 'answer';
    }

}
