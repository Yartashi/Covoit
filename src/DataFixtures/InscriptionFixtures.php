<?php
/**
 * Created by PhpStorm.
 * User: rosie
 * Date: 29/04/20
 * Time: 18:20
 */

namespace App\DataFixtures;


use App\Entity\Inscription;

class InscriptionFixtures
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $Inscription1 = new Inscription();
        $date = new \DateTime('+0 days');

        $Inscription1 -> setUtilisateur($manager->merge($this->getReference('utilisateur-1')))
            ->setTrajet($manager->merge($this->getReference('trajet-2')))
            ->setMDateInsc($date)
            ->setNbPassage(1);

        $manager->persist($Inscription1);

        $manager->flush();

        $Inscription2 = new Inscription();
        $date = new \DateTime('+0 days');

        $Inscription2 -> setUtilisateur($manager->merge($this->getReference('utilisateur-2')))
            ->setTrajet($manager->merge($this->getReference('trajet-2')))
            ->setMDateInsc($date)
            ->setNbPassage(1);

        $manager->persist($Inscription2);

        $manager->flush();

        $Inscription3 = new Inscription();
        $date = new \DateTime('+0 days');

        $Inscription3 -> setUtilisateur($manager->merge($this->getReference('utilisateur-5')))
            ->setTrajet($manager->merge($this->getReference('trajet-2')))
            ->setMDateInsc($date)
            ->setNbPassage(1);

        $manager->persist($Inscription3);

        $manager->flush();

        $Inscription4 = new Inscription();
        $date = new \DateTime('+1 days');

        $Inscription4 -> setUtilisateur($manager->merge($this->getReference('utilisateur-3')))
            ->setTrajet($manager->merge($this->getReference('trajet-1')))
            ->setMDateInsc($date)
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