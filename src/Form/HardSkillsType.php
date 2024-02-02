<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\HardSkill;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class HardSkillsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la compétence',
                'attr' => [
                    "class" => "form-input-skills"
                ]
            ])
            ->add('imageFile', VichFileType::class, [
                'label' => 'Image de la compétence',
                'required' => false,
                'allow_delete'=> true,
                'download_uri' => true,
                'attr' => [
                    "class" => "form-input-skills"
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => "Catégorie",
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => "",
                'attr' => [
                    "class" => "form-input-skills"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HardSkill::class,
        ]);
    }
}
