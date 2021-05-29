<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\UsersRepository;
use App\Repository\ProduitsRepository;
use App\Repository\VendeursRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeProduitRepository;
use App\Repository\CategorieProduiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    
    public function AjoutProduit(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $passwordEncode,ProduitsRepository $ProduitsRepository,CategorieProduiRepository $CategorieRepository,VendeursRepository $VendeurRepository,UsersRepository $UserRepository,TypeProduitRepository $typeProduitRepository)
    {
     
        $user = $this->tokenStorage->getToken()->getUser();
        $values = json_decode($request->getContent());
        $vendeur=$VendeurRepository->findOneBy(array('users' => $user));
        //$categories =$CategorieRepository->findOneBy(array('id'=>$values->categorie));
        //$typeproduits=$typeProduitRepository->findOneBy(array('id'=>$values->type_produit));

        $dateJours = new \DateTime();
        $Produits= new Produits;
        $image = $request->files->get("image");

        $image = fopen($image->getRealPath(),"rb");
        $nom = $request->request->all()["designation"];
        $prix_unitaire = $request->request->all()["prixunitaire"];
        $quantite_stock = $request->request->all()["quantitestock"];
        $caracteristique = $request->request->all()["caracteristique"];
        $description = $request->request->all()["description"];
        $isActive= $request->request->all()["isActive"];
        $categorie=$request->request->all()["categorie"];
        $categories =$CategorieRepository->findOneBy(array('id'=>$categorie));
        $typeproduit=$request->request->all()["typeProduit"];
        $typeproduits=$typeProduitRepository->findOneBy(array('id'=>$typeproduit));

        $Produits->setDesignation($nom);
        $Produits->setPrixunitaire($prix_unitaire);
        $Produits->setQuantitestock($quantite_stock);
        $Produits->setCaracteristique($caracteristique);
        $Produits->setDescription($description);
        $Produits->setCategorie($categories);
        $Produits->setDateAjout( $dateJours);
        $Produits->setIsActive($isActive);
        $Produits->setTypeProduit($typeproduits);
        $Produits->setImage($image);
         
        $Produits->setVendeur( $vendeur);
        $Produits->setDateAjout($dateJours);
       
    
                 $manager->persist($Produits);
                 $manager->flush();
                 fclose($image);
      

               $data = [
                'status' => 201,
                'message' => 'produit ajouter'];
    
                return new JsonResponse($data, 201);
                
     

        }
    /**
     * @Route("/liste/produits", name="list" ,methods={"GET"})
     */
    public function index( SerializerInterface $serializer,EntityManagerInterface $manager,UserPasswordEncoderInterface $passwordEncode,ProduitsRepository $ProduitsRepository,CategorieProduiRepository $CategorieRepository,VendeursRepository $VendeurRepository,UsersRepository $UserRepository,TypeProduitRepository $typeProduitRepository): Response
    {
        $data = $ProduitsRepository->findAll();
       
        $images = [];
        foreach ($data as $key => $entity) {
           // $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
            $entity->setImage((base64_encode(stream_get_contents($entity->getImage()))));
        }
        
        $images= $serializer->serialize($data, 'json');

        return new Response($images, 200, [
            'Content-Type' => 'application/json'
        ]);

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
     */
     public function RemovePanier(SessionInterface $session, $id){

     $panier=$session->get('panier',[]);
     if(!empty($panier[$id])){
      unset($panier[$id]);
      $session->set("panier",$panier);
     }

     }

}
