<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType, IntegerType, TextareaType, TextType, DateType};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $commonClass = "u-full-width";

        $days = ["Не выбрано" => null];
        for ($i = 1; $i <= 31; $i++) {$days[$i] = $i;}
        $months = [
            "Не выбрано" => null,
            "Январь" => 1,
            "Февраль" => 2,
            "Март" => 3,
            "Апрель" => 4,
            "Май" => 5,
            "Июнь" => 6,
            "Июль" => 7,
            "Август" => 8,
            "Сентябрь" => 9,
            "Октябрь" => 10,
            "Ноябрь" => 11,
            "Декабрь" => 12,
        ];

        $years = ["Не выбрано" => null,];
        $currentYear = (int) date('Y');
        for($i = $currentYear; $i > 1970; $i--) {
            $years[$i] = $i;
        }

        $builder
            ->add('firstname', TextType::class, ["label" => "Имя",  "attr" => ["class" => $commonClass, "required" => true, "placeholder" => "Имя"]])
            ->add('lastname', TextType::class, ["label" => "Фамилия",  "attr" => ["class" => $commonClass, "required" => true]])
            ->add('day', ChoiceType::class, ['choices' => $days, "label" => "Дата рождения",  "attr" => ["class" => $commonClass, "required" => true]])
            ->add('month', ChoiceType::class, ['choices' => $months, "label" => "Месяц рождения",  "attr" => ["class" => $commonClass, "required" => true]])
            ->add('year', ChoiceType::class, ['choices' => $years, "label" => "Гож рождения",  "attr" => ["class" => $commonClass, "required" => false]])
            ->add('comment',TextareaType::class, ["label" => "Комментарий", "attr" => ["class" => $commonClass]])
            ->add('save', SubmitType::class, ['label' => 'Сохранить', "attr" => ["class" => "button-primary u-pull-right"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
