<?php

namespace App\Form;

use App\Entity\Ad;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType

{
    /**
     * Permet d'uavoir la configuration de base d'un champ!
     *
     * @param string $placeholder
     * @param string $label
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return [
            
                'label' => $label,
                'attr' => ['placeholder'=> $placeholder 

                ]
            
            ];

    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,$this->getConfiguration("Titre", "Tapez un super titre pour votre annonce"))
            ->add('slug',TextType::class,$this->getConfiguration("Adresse web", "Tapez l'adresse web (automatique)"))
            ->add('coverImage',UrlType::class,$this->getConfiguration("Url de l'image Principale","Donnezl'adresse d'une image qui donne vraiment envie "))
            ->add('introduction',TextType::class,$this->getConfiguration("Introduction","Donnez une description globale de l'annonce"))
            ->add('content', TextareaType::class,$this->getConfiguration("Déscription Détaillée","Tapez une description qui donne envie de venir chez vous !"))
            ->add('rooms',IntegerType::class,$this->getConfiguration("Nombre de chambres","le nombre de chambres disponibles"))
            ->add('price',MoneyType::class,$this->getConfiguration("prix par nuit","Indiquez le prix que vous voulez pour la nuit "))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
