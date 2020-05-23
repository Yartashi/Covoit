<?php
namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
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
            ->setAdresse("97 rue des moulins Paris");
        $naiss = new \DateTime("1996-06-05");
        //$naiss = new DateTimeInterface("05/06/1996");
        $utilisateur1->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr");

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setUsername("Cam84")
            ->setNom("Armelo")
            ->setPrenom("Camille")
            ->setmail("Armelo.Camille@gmail.fr")
            ->setNumTel("02389624")
            ->setPassword("mdp")
            ->setAdresse("37 rue des cheminaux Nantes");
        $naiss = new \DateTime("1984-02-10");
        //$naiss = new DateTimeInterface("10/02/1984");
        $utilisateur2->setDateNaiss($naiss)
            ->setStyleChoix(2)
            ->setLangueChoix("en");

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setUsername("Amandine")
            ->setNom("Berger")
            ->setPrenom("Amandine")
            ->setmail("amandine.ber@outlook.fr")
            ->setNumTel("0632618606")
            ->setPassword("mdp")
            ->setAdresse("96 rue du chêne creux Rennes");
        $naiss = new \DateTime("1962-09-25");
        //$naiss = new DateTimeInterface("25/09/1962");
        $utilisateur3->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr");

        $utilisateur4 = new Utilisateur();
        $utilisateur4->setUsername("Becass")
            ->setNom("Cousine")
            ->setPrenom("Becassine")
            ->setmail("becassine.ta.cousine@wanadoo.fr")
            ->setNumTel("0632696606")
            ->setPassword("mdp")
            ->setAdresse("85 rue des jonquilles Lille");
        $naiss = new \DateTime("1986-08-01");
        //$naiss = new DateTimeInterface("01/08/1986");
        $utilisateur4->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr");
        
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
            ->addRole("ROLE_ADMIN");

        $utilisateur6 = new Utilisateur();
        $utilisateur6->setUsername("Yartashi")
            ->setNom("Ayral")
            ->setPrenom("Christian")
            ->setmail("yartashi@gmail.fr")
            ->setNumTel("0632589742")
            ->setPassword("mdp")
            ->setAdresse("quelqu");
        $naiss = new \DateTime("1994-05-19");
        //$naiss = new DateTimeInterface("19/11/1992");
        $utilisateur6->setDateNaiss($naiss)
            ->setStyleChoix(2)
            ->setLangueChoix("fr")
            ->addRole("ROLE_ADMIN");

        $utilisateur7 = new Utilisateur();
        $utilisateur7->setUsername("Imania")
            ->setNom("Camille")
            ->setPrenom("Panika")
            ->setmail("Imania@gmail.fr")
            ->setNumTel("0608963241")
            ->setPassword("mdp")
            ->setAdresse("97 rue des trefles Pau");
        $naiss = new \DateTime("1992-11-19");
        //$naiss = new DateTimeInterface("19/11/1992");
        $utilisateur7->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr")
            ->addRole("ROLE_USER"); 

        $utilisateur8 = new Utilisateur();
        $utilisateur8->setUsername("Paupey")
            ->setNom("Peyronnel")
            ->setPrenom("Pauline")
            ->setmail("paupey@gmail.fr")
            ->setNumTel("0638924263")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1992-11-19");
        //$naiss = new DateTimeInterface("19/11/1992");
        $utilisateur8->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("fr")
            ->addRole("ROLE_USER"); 

        $utilisateur9 = new Utilisateur();
        $utilisateur9->setUsername("Luminas")
            ->setNom("René")
            ->setPrenom("Limurge")
            ->setmail("Luminas@gmail.fr")
            ->setNumTel("0638634263")
            ->setPassword("mdp")
            ->setAdresse("somewhere");
        $naiss = new \DateTime("1982-10-20");
        //$naiss = new DateTimeInterface("19/11/1992");
        $utilisateur9->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("en")
            ->addRole("ROLE_USER");

        $utilisateur10 = new Utilisateur();
        $utilisateur10->setUsername("Prania")
            ->setNom("Prania")
            ->setPrenom("Panel")
            ->setmail("Prania.Panel@gmail.fr")
            ->setNumTel("0638986263")
            ->setPassword("mdp")
            ->setAdresse("....");
        $naiss = new \DateTime("1987-09-01");
        //$naiss = new DateTimeInterface("19/11/1992");
        $utilisateur10->setDateNaiss($naiss)
            ->setStyleChoix(1)
            ->setLangueChoix("en")
            ->addRole("ROLE_USER"); 



        $manager->persist($utilisateur1);
        $manager->persist($utilisateur2);
        $manager->persist($utilisateur3);
        $manager->persist($utilisateur4);
        $manager->persist($utilisateur5);
        $manager->persist($utilisateur6);
        $manager->persist($utilisateur7);
        $manager->persist($utilisateur8);
        $manager->persist($utilisateur9);
        $manager->persist($utilisateur10);

        $manager->flush();

        $this->addReference('utilisateur-1',$utilisateur1);
        $this->addReference('utilisateur-2',$utilisateur2);
        $this->addReference('utilisateur-3',$utilisateur3);
        $this->addReference('utilisateur-4',$utilisateur4);
        $this->addReference('utilisateur-5',$utilisateur5);
        $this->addReference('utilisateur-1',$utilisateur6);
        $this->addReference('utilisateur-2',$utilisateur7);
        $this->addReference('utilisateur-3',$utilisateur8);
        $this->addReference('utilisateur-4',$utilisateur9);
        $this->addReference('utilisateur-5',$utilisateur10);
    }
    
}