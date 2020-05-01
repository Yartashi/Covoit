<?php
namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use DateTimeInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $Commentaire1 = new Commentaire();
        
        $Commentaire1 -> setUtilisateur($manager->merge($this->getReference('utilisateur-1')))
        ->setTrajet($manager->merge($this->getReference('trajet-1')))
        ->setMessageComm("Ceci est un test");
        $date = new \DateTime("2020-04-25");
        $Commentaire1->setDateComm($date);

        $manager->persist($Commentaire1);

        $manager->flush();


    }
    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            UtilisateurFixtures::class,
            TrajetFixtures::class
        );
    }
}