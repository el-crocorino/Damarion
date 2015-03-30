<?php

    namespace Damarion\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    class VoteType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {

            $builder->add('answer_id', 'choice', array(
                 'choices' => $options['data'],
                 'expanded' => true,
                 'multiple' => false
            ));

        }

        public function getName() {
            return 'vote';
        }

        public function handleRequest() {

        }

    }
