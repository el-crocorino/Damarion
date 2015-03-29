<?php

    namespace Damarion\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    class CommentType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder->add('content', 'textarea')
                    ->add('answer_id', 'choice', array(
                         'choices' => $answers,
                         'expanded' => true,
                         'multiple' => false
                    ));
        }

        public function getName() {
            return 'vote';
        }

    }
