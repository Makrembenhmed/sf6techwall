<?php

namespace App\Form;

use App\Entity\Hobby;
use App\Entity\Job;
use App\Entity\Personne;
use App\Entity\Profile;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('name')
            ->add('age')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('profile',EntityType::class ,[
                'expanded'=>false,
                'required'=>false,
                'class'=> Profile::class,
                'multiple'=>false,
                'attr'=> ['class'=> 'select2'],

            ])
            ->add('hobbies',EntityType::class,[ 'expanded'=>false,
            'class'=> Hobby::class,
            'multiple'=>true,
            'required'=>false,
            'query_builder' => function (EntityRepository $er): ORMQueryBuilder {
                return $er->createQueryBuilder('h')
                    ->orderBy('h.designation', 'ASC');
            },
            'choice_label' => 'designation',
            'attr'=> ['class'=> 'select2'],
            ])
            ->add('job',EntityType ::class,[
                'class'=> Job::class,
                'attr'=> ['class'=> 'select2'],
                'required'=>false,



            ])
            ->add('photo', FileType::class, [
                'label' => 'Votre Image de profile( des fichies images uniquement)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg', 
                            'image/gif',
                            
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            ->add('editer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
