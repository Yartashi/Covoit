<?php
/**
 * Created by PhpStorm.
 * User: rosie
 * Date: 29/04/20
 * Time: 18:20
 */

namespace App\DataFixtures;


use App\Entity\Inscription;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     * @throws \Exception
     */
    public function load(ObjectManager $manager) : void
    {
        $Inscription1 = new Inscription();
        $date = new \DateTime('+1 days');

        $Inscription1 -> setUtilisateur($manager->merge($this->getReference('utilisateur-1')))
            ->setTrajet($manager->merge($this->getReference('trajet-2')))
            ->setDateInscr($date)
            ->setNbPassage(1);

        $manager->persist($Inscription1);

        $manager->flush();

        $Inscription2 = new Inscription();
        $date = new \DateTime('+1 days');

        $Inscription2 -> setUtilisateur($manager->merge($this->getReference('utilisateur-2')))
            ->setTrajet($manager->merge($this->getReference('trajet-2')))
            ->setDateInscr($date)
            ->setNbPassage(1);

        $manager->persist($Inscription2);

        $manager->flush();

        $Inscription3 = new Inscription();
        $date = new \DateTime('+1 days');

        $Inscription3 -> setUtilisateur($manager->merge($this->getReference('utilisateur-5')))
            ->setTrajet($manager->merge($this->getReference('trajet-2')))
            ->setDateInscr($date)
            ->setNbPassage(1);

        $manager->persist($Inscription3);

        $manager->flush();

        $Inscription4 = new Inscription();
        $date = new \DateTime('+2 days');

        $Inscription4 -> setUtilisateur($manager->merge($this->getReference('utilisateur-3')))
            ->setTrajet($manager->merge($this->getReference('trajet-1')))
            ->setDateInscr($date)
            ->setNbPassage(1);

        $manager->persist($Inscription4);

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