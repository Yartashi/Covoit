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
Blabla de test 1
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
        Blabla de test 2
_lorem;

        $trajet2->setConducteurId($manager->merge($this->getReference('utilisateur-4')))
            ->setDescription($description)
            ->setVilleDep('Paris')
            ->setVilleDest('Saint-Malo')
            ->setDateDep(new \DateTime('+5 days'))
            ->setNombrePlacesMax(3)
            ->setStatut(1);

        $this->addReference('trajet-1', $trajet1);
        $this->addReference('trajet-2', $trajet2);
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