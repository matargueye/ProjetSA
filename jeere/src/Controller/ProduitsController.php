<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Vendeurs;
use App\Entity\CategorieProdui;
use App\Repository\UsersRepository;
use App\Repository\ProduitsRepository;
use App\Repository\VendeursRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MediaObjectRepository;
use App\Repository\CategorieProduiRepository;
use App\Repository\TypeProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProduitsController extends AbstractController
{

    public function __construct(TokenStorageInterface $tokenStorage,UserPasswordEncoderInterface $encoder)
    {
        
    $this->tokenStorage = $tokenStorage;
    $this->encoder = $encoder;
    }
    /**
     * @Route("api/ajout/produits", name="produits",methods={"POST"})
    
     */
    
    public function newCompte(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $passwordEncode,ProduitsRepository $ProduitsRepository,CategorieProduiRepository $CategorieRepository,VendeursRepository $VendeurRepository,UsersRepository $UserRepository,MediaObjectRepository $MediaObjectRepository,TypeProduitRepository $typeProduitRepository)
    {
     
        $user = $this->tokenStorage->getToken()->getUser();
        $values = json_decode($request->getContent());
        $vendeur=$VendeurRepository->findOneBy(array('users' => $user));
        $categories =$CategorieRepository->findOneBy(array('id'=>$values->categorie));
        $mediaobjet =$MediaObjectRepository->findOneBy(array('id'=>$values->image));
        $typeproduits=$typeProduitRepository->findOneBy(array('id'=>$values->type_produit));

        $dateJours = new \DateTime();
        $Produits= new Produits;
        $Produits->setNomProduit($values->nom_produit);
        $Produits->setPrixUnitaire($values->prix_unitaire);
        $Produits->setQuantiteStock($values->quantite_stock);
        $Produits->setCaracteristique($values->caracteristique);
        $Produits->setDescription($values->description);
        $Produits->setCategorie($categories);
        $Produits->setDateAjout( $dateJours);
        $Produits->setIsActive($values->isActive);
        $Produits->setTypeProduit( $typeproduits);
        $Produits->setImage( $mediaobjet);
       
        
    
        $Produits->setVendeur( $vendeur);
        $Produits->setDateAjout($dateJours);
       
    
                 $manager->persist($Produits);
                 $manager->flush();

               $data = [
                'status' => 201,
                'message' => 'produit ajouter'];
    
                return new JsonResponse($data, 201);
                
     

        }

     /**
     * @Route("api/ajout/add_produits/{id}", name="produits_panier",methods={"POST"})
     */
    public function add($id,SessionInterface $session){

     $panier=$session->get('panier',[]);
     if(!empty($panier[$id])){
       $panier[$id]++;

     }else{
       $panier[$id]=1;
 
     }
     $panier[$id]=1;
     $session->set('panier',$panier);
     dd($session->get('panier',$panier));


    }
     /**
     * @Route("api/panier", name="paniers",methods={"GET"})
     */
    public function recupPanier(SessionInterface $session,ProduitsRepository $ProduitsRepository){
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
  
      }

     /**
     * @Route("api/remove/panier/{id}", name="remove_panier",methods={""})
     * 
     * 
     */
     public function RemovePanier(SessionInterface $session, $id){

     $panier=$session->get('panier',[]);
     if(!empty($panier[$id])){
      unset($panier[$id]);
      $session->set("panier",$panier);
     }

     }


}
