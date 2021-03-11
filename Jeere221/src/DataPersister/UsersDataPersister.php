<?php
namespace App\DataPersister;

use App\Entity\User;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements DataPersisterInterface
 {
    private $userPasswordEncoder;
    public function __construct(EntityManagerInterface $entitymanager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entitymanager;
    }
    public function supports($data): bool
    {
        return $data instanceof Users;
        // TODO: Implement supports() method.
    }
   public function persist($data)
   {
    
    if ($data->getPasword()) {
        $data->setPasword(
            $this->userPasswordEncoder->encodePassword($data, $data->getPasword())
        );
        $data->eraseCredentials();
    }
      


       $this->entityManager->persist($data);
       $this->entityManager->flush();
   }

   public function remove($data)
   {
    $this->entityManager->remove($data);
    $this->entityManager->flush();
       // TODO: Implement remove() method.
   }
 }