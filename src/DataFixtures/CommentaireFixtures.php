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
        
        $Commentaire1 -> setUtilisateur($manager->merge($this->getReference('utilisateur-2')))
        ->setTrajet($manager->merge($this->getReference('trajet-1')))
        ->setMessageComm("Bonjour,je voulais savoir qu'elle est le tarif pour le voyage.");
        $date = new \DateTime("-2 days");
        $Commentaire1->setDateComm($date);

        $manager->persist($Commentaire1);

        $Commentaire2 = new Commentaire();
        
        $Commentaire2 -> setUtilisateur($manager->merge($this->getReference('utilisateur-1')))
        ->setTrajet($manager->merge($this->getReference('trajet-1')))
        ->setMessageComm("C'est 10€ par personne ! :D");
        $date = new \DateTime("-1 days");
        $Commentaire2->setDateComm($date);

        $manager->persist($Commentaire2);

        $Commentaire3 = new Commentaire();
        
        $Commentaire3 -> setUtilisateur($manager->merge($this->getReference('utilisateur-1')))
        ->setTrajet($manager->merge($this->getReference('trajet-2')))
        ->setMessageComm("Bonsoir, rdv où et pour combien.");
        $date = new \DateTime("-10 days");
        $Commentaire3->setDateComm($date);

        $manager->persist($Commentaire3);

        $Commentaire4 = new Commentaire();
        
        $Commentaire4 -> setUtilisateur($manager->merge($this->getReference('utilisateur-1')))
        ->setTrajet($manager->merge($this->getReference('trajet-2')))
        ->setMessageComm("C'est comme vous voulez on s'arrange, 15€ ");
        $date = new \DateTime("-10 days");
        $Commentaire4->setDateComm($date);

        $manager->persist($Commentaire4);

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