<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\HardSkill;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom du projet",
                'attr' => [
                    "class" => "form-input-projects"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description du projet",
                'attr' => [
                    "class" => "form-input-projects"
                ]
            ])
            ->add('urlGithub', TextType::class, [
                'label' => "Lien du Github",
                'attr' => [
                    "class" => "form-input-projects"
                ]
            ])
            ->add('imageFile', VichFileType::class, [
                'label' => "Image du projet",
                'required' => false,
                'allow_delete'=> true,
                'download_uri' => true,
                'attr' => [
                    "class" => "form-input-projects"
                ]
            ])
            ->add('hardSkills', EntityType::class, [
                'class' => HardSkill::class,
                'label' => "Sélectionner les compétences en lien au projet",
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    "class" => "form-input-projects"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
