<?php
namespace App\DataFixtures;

use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrajetFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $trajet1 = new trajet();

        $description = <<< _lorem
Bonjour, départ à 14h, au rond point de Paris. N'hésitez pas à me contacter !
_lorem;

        $trajet1->setConducteurId($manager->merge($this->getReference('utilisateur-1')))
            ->setDescription($description)
            ->setVilleDep('Nantes')
            ->setVilleDest('Brest')
            ->setDateDep(new \DateTime('+10 days'))
            ->setNombrePlacesMax(3)
            ->setStatut(1);

        $trajet2 = new trajet();
        
        $description = <<< _lorem
        Si vous êtes intéressé, contactez moi.
_lorem;

        $trajet2->setConducteurId($manager->merge($this->getReference('utilisateur-4')))
            ->setDescription($description)
            ->setVilleDep('Paris')
            ->setVilleDest('Saint-Malo')
            ->setDateDep(new \DateTime('+5 days'))
            ->setNombrePlacesMax(2)
            ->setStatut(1);

        $trajet3 = new trajet();
        $description = <<< _lorem
        Si vous êtes intéressé, contactez moi par mail.
_lorem;

        $trajet3->setConducteurId($manager->merge($this->getReference('utilisateur-4')))
            ->setDescription($description)
            ->setVilleDep('Marseille')
            ->setVilleDest('Lyon')
            ->setDateDep(new \DateTime('-4 days'))
            ->setNombrePlacesMax(3)
            ->setStatut(2);


        $trajet4 = new trajet();
        $description = <<< _lorem
        Bonsoir, papote au détour, si ca vous va ! 
    _lorem;
    
        $trajet4->setConducteurId($manager->merge($this->getReference('utilisateur-2')))
            ->setDescription($description)
            ->setVilleDep('Tours')
            ->setVilleDest('Lyon')
            ->setDateDep(new \DateTime('+10 days'))
            ->setNombrePlacesMax(4)
            ->setStatut(1);


        $trajet5 = new trajet();
        $description = <<< _lorem
        Voiture 8 places, peu de coffre, pas d'animaux.
_lorem;

        $trajet5->setConducteurId($manager->merge($this->getReference('utilisateur-5')))
            ->setDescription($description)
            ->setVilleDep('Paris')
            ->setVilleDest('Marseille')
            ->setDateDep(new \DateTime('+6 days'))
            ->setNombrePlacesMax(6)
            ->setStatut(1);


        $trajet6 = new trajet();
        $description = <<< _lorem
        Beaucoup de places dans le coffre mais j'ecoute de la musique !
_lorem;

        $trajet6->setConducteurId($manager->merge($this->getReference('utilisateur-1')))
            ->setDescription($description)
            ->setVilleDep('Nantes')
            ->setVilleDest('Brest')
            ->setDateDep(new \DateTime('+6 days'))
            ->setNombrePlacesMax(3)
            ->setStatut(2);


        $trajet7 = new trajet();
        $description = <<< _lorem
        Cats and dogs friendly, hope you'll be interested !
_lorem;

        $trajet7->setConducteurId($manager->merge($this->getReference('utilisateur-3')))
            ->setDescription($description)
            ->setVilleDep('London')
            ->setVilleDest('Plymouth')
            ->setDateDep(new \DateTime('+4 days'))
            ->setNombrePlacesMax(2)
            ->setStatut(1);


        $trajet8 = new trajet();
        $description = <<< _lorem
        Climatisation, bonne humeur et tranquilité garanti.
_lorem;

        $trajet8->setConducteurId($manager->merge($this->getReference('utilisateur-4')))
            ->setDescription($description)
            ->setVilleDep('Nantes')
            ->setVilleDest('Tours')
            ->setDateDep(new \DateTime('+4 days'))
            ->setNombrePlacesMax(3)
            ->setStatut(1);


        $trajet9 = new trajet();
        $description = <<< _lorem
        Si vous êtes intéressé, contactez moi par mail.
_lorem;

        $trajet9->setConducteurId($manager->merge($this->getReference('utilisateur-8')))
            ->setDescription($description)
            ->setVilleDep('Rennes')
            ->setVilleDest('Saint Brieuc')
            ->setDateDep(new \DateTime('+7 days'))
            ->setNombrePlacesMax(1)
            ->setStatut(1);


        $trajet10 = new trajet();
        $description = <<< _lorem
        Trajet tout les vendredis soir
_lorem;

        $trajet10->setConducteurId($manager->merge($this->getReference('utilisateur-7')))
            ->setDescription($description)
            ->setVilleDep('Nice')
            ->setVilleDest('Lille')
            ->setDateDep(new \DateTime('+1 days'))
            ->setNombrePlacesMax(2)
            ->setStatut(1);

            $trajet3 = new trajet();
        $description = <<< _lorem
        Si vous êtes intéressé, contactez moi par mail.
_lorem;


        $this->addReference('trajet-1', $trajet1);
        $this->addReference('trajet-2', $trajet2);
        $this->addReference('trajet-3', $trajet3);
        $this->addReference('trajet-4', $trajet4);
        $this->addReference('trajet-5', $trajet5);
        $this->addReference('trajet-6', $trajet6);
        $this->addReference('trajet-7', $trajet7);
        $this->addReference('trajet-8', $trajet8);
        $this->addReference('trajet-9', $trajet9);
        $this->addReference('trajet-10', $trajet10);

        $manager->persist($trajet1);
        $manager->persist($trajet2);
        $manager->persist($trajet3);
        $manager->persist($trajet4);
        $manager->persist($trajet5);
        $manager->persist($trajet6);
        $manager->persist($trajet7);
        $manager->persist($trajet8);
        $manager->persist($trajet9);
        $manager->persist($trajet10);
        $manager->flush();
    }

    /**s
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            UtilisateurFixtures::class
        );
    }
}