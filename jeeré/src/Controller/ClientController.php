<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Clients;
use App\Repository\RoleRepository;
use App\Repository\UsersRepository;
use App\Repository\ClientsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientController extends AbstractController
{


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
    
    $this->encoder = $encoder;
    }
    /**
    * @Route("/new/clients", name="clients", methods={"POST"}))
    * 
     */
    public function newCompte(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $passwordEncode,RoleRepository $roleRepository,UsersRepository $userRepository,ClientsRepository $ClientsRepository)
    {
     
        $values = json_decode($request->getContent());
        $user = new Users();
        $client = new Clients();
     
        $role = $roleRepository->findOneBy(array('Libelle' => 'client'));
        
        $user = new Users();
        $user->setUsername($values->username);
        $user->setRole($role);
        $user->setPassword($this->encoder->encodePassword($user,$values->password));
        $user->setPrenom($values->prenom);
        $user->setNom($values->nom);
        $user->getRoles();
      
       
        $client->setAdresseClient($values->adresse_client)
               ->setTelClient($values->tel_client)
               ->SetUsers($user)
               ->getUsers();
               $manager->persist($user);
               $manager->persist($client);
               $manager->flush();

               $data = [
                'status' => 201,
                'message' => 'création compte réussi'];
    
                return new JsonResponse($data, 201);
                



        }


}
