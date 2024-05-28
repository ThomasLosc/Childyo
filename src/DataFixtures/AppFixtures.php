<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Medecin;
use App\Entity\Enfant;
use App\Entity\RendezVous;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Créer 5 médecins
        $medecins = [];
        for ($i = 0; $i < 5; $i++) {
            $medecin = new Medecin();
            $medecin->setNom($faker->lastName);
            $medecin->setPrenom($faker->firstName);
            $medecin->setPhoto($faker->imageUrl(640, 480, 'people'));
            $medecin->setDomaine($faker->word);

            $manager->persist($medecin);
            $medecins[] = $medecin;
        }

        // Créer 5 utilisateurs
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setNom($faker->lastName);
            $user->setPrenom($faker->firstName);
            $user->setTelephone($faker->randomNumber(9, true));
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_USER']);
            $user->setIsVerified(true);
            $password = $this->passwordHasher->hashPassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);

            // Créer 2 enfants par utilisateur
            for ($j = 0; $j < 2; $j++) {
                $enfant = new Enfant();
                $enfant->setNom($faker->lastName);
                $enfant->setPrenom($faker->firstName);
                $enfant->setDateNaissance($faker->dateTimeBetween('-10 years', '-2 years'));
                $enfant->setMedecinTraitant($faker->randomElement($medecins)->getNom());
                $enfant->setGenre($faker->boolean);
                $enfant->setUser($user);

                $manager->persist($enfant);

                // Créer 2 rendez-vous par enfant
                for ($k = 0; $k < 2; $k++) {
                    $rendezVous = new RendezVous();
                    $rendezVous->setDate($faker->dateTimeBetween('now', '+1 years'));
                    $rendezVous->setTypeConsultation($faker->word);
                    $rendezVous->setMotif($faker->sentence);
                    $rendezVous->setEnfant($enfant);
                    $rendezVous->setMedecin($faker->randomElement($medecins));

                    $manager->persist($rendezVous);
                }
            }
        }

        $manager->flush();
    }
}
