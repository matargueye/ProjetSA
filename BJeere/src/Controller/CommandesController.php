<?php

namespace App\Controller;

use App\Entity\Factures;
use App\Entity\Commandes;
use App\Repository\ClientsRepository;
use App\Repository\PaniersRepository;
use App\Repository\FacturesRepository;
use App\Repository\LivreursRepository;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommandesController extends AbstractController
{   
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        
    $this->tokenStorage = $tokenStorage;

    }
    /**
     * @Route("/api/commandes", name="commandes",methods={"POST"})
     */
    public function newCompte(Request $request,SessionInterface $session,EntityManagerInterface $manager,CommandesRepository $CommandeRepository,FacturesRepository $FacturesRepository,livreursRepository $livreursRepository,ClientsRepository $ClientRepository)
    {
     
        $values = json_decode($request->getContent());
        $commandes = new Commandes();
        $facture = new Factures();
        $dateJours = new \DateTime();
        $user = $this->tokenStorage->getToken()->getUser();
        $client =$ClientRepository->findOneBy(array('users'=>$user));
      
        $livreur =$livreursRepository->findOneBy(array('id'=>$values->livreurs_id));
        $panier=$session->get('panier',[]);
        $panierData=[];
        foreach($panier as $id=> $quantity){
  
        $panierData=[
          "produit"=>$ProduitsRepository->find($id),
          "qantity"=>$quantity
        ];
         dd($panierData);
  
         }
       $totale=0;
       foreach($panierData as $item){
       $totaleItem=$item['produit']->getPrix * $item['quantity'];
       $totale +=$totaleItem;
       return $totale;
       }

        $commandes->setDateCommande($dateJours );
        $commandes->setEtat($values->etat);
        $commandes->setLivreurs( $livreur);
        $commandes->setFacture($facture);
        $commandes->setClient($user);
        $commandes->setNomClient($user->getNom());
        $commandes->setTel($client->getTelClient());
        $commandes->setAdresse($client->getAdresseClient());
       
        $factures->setDateFacture($dateJours);
                
                 $manager->persist($commandes);
                $manager->persist($factures);
               $manager->flush();

               $data = [
                'status' => 201,
                'message' => 'cr??ation compte r??ussi'];
    
                return new JsonResponse($data, 201);
                



        }
}
