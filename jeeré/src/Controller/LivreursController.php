<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Villes;
use App\Entity\Livreurs;
use App\Repository\RoleRepository;
use App\Repository\UsersRepository;
use App\Repository\LivreursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LivreursController extends AbstractController
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
    
    $this->encoder = $encoder;
    }
    /**
     * @Route("api/new/livreurs", name="livreurs")
     */
    public function newCompte(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $passwordEncode,RoleRepository $roleRepository,UsersRepository $userRepository,LivreursRepository $LivreursRepository)
    {
     
        $values = json_decode($request->getContent());
        $dateJours = new \DateTime();
        $user = new Users();
        $Livreurs= new Livreurs;
        $ville= new Villes;
        $role = $roleRepository->findOneBy(array('Libelle' => 'livreur'));
      
     
       
    

        
        $user = new Users();
        $user->setUsername($values->username);
        $user->setRole($role);
        $user->setPassword($this->encoder->encodePassword($user,$values->password));
        $user->setPrenom($values->prenom);
        $user->setNom($values->nom);
        $user->getRoles();
      
        $Livreurs->setAdresseLivreur($values->adresse_livreur)
        ->setTelLivreur($values->tel_livreur)
        ->setPhotoCNIL($values->photo_cni_l)
        ->setVille($values->ville)
        ->SetUsers($user)
        ->getUsers();
      
      
       

                 $manager->persist($user);
                 $manager->persist($Livreurs);
                 $manager->flush();

               $data = [
                'status' => 201,
                'message' => 'création compte réussi'];
    
                return new JsonResponse($data, 201);
                



        }
}
