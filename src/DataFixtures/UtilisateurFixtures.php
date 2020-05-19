<?php
namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture 
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $utilisateur1 = new Utilisateur();
        $utilisateur1->setUsername("Dudu")
            ->setNom("Dupont")
            ->setPrenom("Etienne")
            ->setmail("dupont.etienne@gmail.fr")
            ->setNumTel("0632618606")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1996-06-05");
        //$naiss = new DateTimeInterface("05/06/1996");
        $utilisateur1->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr")
            ->setRole("Inscrit");

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setUsername("Cam84")
            ->setNom("Armelo")
            ->setPrenom("Camille")
            ->setmail("Armelo.Camille@gmail.fr")
            ->setNumTel("02389624")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1984-02-10");
        //$naiss = new DateTimeInterface("10/02/1984");
        $utilisateur2->setDateNaiss($naiss)
            ->setStyleChoix(2)
            ->setLangueChoix("en")
            ->setRole("Inscrit");

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setUsername("Amandine")
            ->setNom("Berger")
            ->setPrenom("Amandine")
            ->setmail("amandine.ber@outlook.fr")
            ->setNumTel("0632618606")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1962-09-25");
        //$naiss = new DateTimeInterface("25/09/1962");
        $utilisateur3->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr")
            ->setRole("Inscrit");

        $utilisateur4 = new Utilisateur();
        $utilisateur4->setUsername("Becass")
            ->setNom("Cousine")
            ->setPrenom("Becassine")
            ->setmail("becassine.ta.cousine@wanadoo.fr")
            ->setNumTel("0632618606")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1986-08-01");
        //$naiss = new DateTimeInterface("01/08/1986");
        $utilisateur4->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr")
            ->setRole("Inscrit");
        
        $utilisateur5 = new Utilisateur();
        $utilisateur5->setUsername("Paupey")
            ->setNom("Peyronnel")
            ->setPrenom("Pauline")
            ->setmail("paupey@gmail.fr")
            ->setNumTel("0638924263")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1992-11-19");
        //$naiss = new DateTimeInterface("19/11/1992");
        $utilisateur5->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr")
            ->setRole("Administrateur");

        $manager->persist($utilisateur1);
        $manager->persist($utilisateur2);
        $manager->persist($utilisateur3);
        $manager->persist($utilisateur4);
        $manager->persist($utilisateur5);

        $manager->flush();

        $this->addReference('utilisateur-1',$utilisateur1);
        $this->addReference('utilisateur-2',$utilisateur2);
        $this->addReference('utilisateur-3',$utilisateur3);
        $this->addReference('utilisateur-4',$utilisateur4);
        $this->addReference('utilisateur-5',$utilisateur5);
    }
    
}