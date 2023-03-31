<?php

namespace App\Controller;

use DateTime;
use App\Entity\Rate;
use App\Entity\Product;
use App\Entity\Reponse;
use App\Entity\Checkout;
use App\Entity\Cotation;
use App\Services\Mesurer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class fccController extends AbstractController
{
    /**
     * @Route("/quote", name="app_quote")
     */
    public function logic(EntityManagerInterface $em){

        //Importation de données du Json
        $checkout = $em->getRepository(Checkout::Class)->findOneBy(['id'=>4]);
        //dd($checkout);


        //On cree une cotation et on la lie au checkout
        $cotation = New Cotation;
        $cotation->setCheckout($checkout);
        $cotation->setDate(New DateTime());
        $em->persist($cotation);
        $em->flush();

        // Lire la liste des produits du checkout
        $products = $em->getRepository(Product::class)->findBy(['Checkout'=>$checkout]);

        //Lire la liste des Rate du pays d'expedition
        $rates = $em->getRepository(Rate::class)->findBy([
                                                            'Country' => $checkout->getShipto(),
                                                            'shipby' => $checkout->getShipby()
                                                        ]);
        //dd($rates);
        //Si Expedition par mer SEA = 2
        if ($checkout->getShipby()->getId()==2) {
            //dd($products);
            $mesure = 0;
            $i=0;
            //$textemesure = "";
            foreach ($products as $product){ //Pour chaque line_items dans le checkout en cours
                //On mesure les lignes selon les methodes en vigueur
                $i++;
                //$textemesure = $textemesure."item ".$i.":".strval($this->getMesures($product))."---";
                
                $mesure += $this->getMesuresMer($product);
               // dump($mesure);
            }
            //dd($mesure);
            //dd($textemesure);

            
            foreach ($rates as $rate){ // Pour chaque Rate decouvert dans le tableau, On ajoute une ligne de reponse a la cotation
                $reponse = New Reponse();
                $reponse->setCotation($cotation);
                $reponse->setMessage($rate->getCharge()->getName());
                $reponse->setAmount($mesure * $rate->getAmount()); // PT =Mesure * prix Unitaire
                $reponse->setAmountCurrency($rate->getPaymentPlace()->getCurrency()); //On capture la monnaie courante du Rate
                $reponse->setPaymentplace($rate->getPaymentPlace()); // On capture le lieu de paiement de la charge
                $em->persist($reponse);
                $em->flush(); // On Stocke la reponse
            }
           // dd($cotation);
        }
        //Si Expedition par mer AIR = 1
        if ($checkout->getShipby()->getId()==1) {
            //dd($products);
            $mesure = 0;
            $i=0;
            //$textemesure = "";
            foreach ($products as $product){ //Pour chaque line_items dans le checkout en cours
                //On mesure les lignes selon les methodes en vigueur
                $i++;
                //$textemesure = $textemesure."item ".$i.":".strval($this->getMesures($product))."---";
                
                $mesure += $this->getMesuresAir($product);
               // dump($mesure);
            }
            //dd($mesure);
            //dd($textemesure);

            
            foreach ($rates as $rate){ // Pour chaque Rate decouvert dans le tableau, On ajoute une ligne de reponse a la cotation
                $reponse = New Reponse();
                $reponse->setCotation($cotation);
                $reponse->setMessage($rate->getCharge()->getName());
                $reponse->setAmount($mesure * $rate->getAmount()); // PT =Mesure * prix Unitaire
                $reponse->setAmountCurrency($rate->getPaymentPlace()->getCurrency()); //On capture la monnaie courante du Rate
                $reponse->setPaymentplace($rate->getPaymentPlace()); // On capture le lieu de paiement de la charge
                $em->persist($reponse);
                $em->flush(); // On Stocke la reponse
            }
           // dd($cotation);
        }

        return $this->render('quote/index.html.twig', [
            'reponses' => $em->getRepository(Reponse::class)->findBy(["Cotation"=>$cotation]),
            'produits'=> $em->getRepository(Product::class)->findBy(["Checkout"=>$checkout]),
            'shipby' => $checkout->getShipby()->getName(),
            'checkout' => $checkout
        ]);

    }

    // Fonction permettant de definir la mesure d'un produit dans un contexte
    private function getMesuresMer(Product $product){
        
        //$mes = 0;
        // On calcule le volume unitaire d'un article
        $volumeunitaire = $product->getMetalength() * $product->getMetawidth() * $product->getMetaheight();
        //On calcule la masse volumique de l'article formule = masse / volume
        $mv = $product->getMetaweight()/($volumeunitaire/1000000); // On divise par 1,000,000 pour ramener les valeurs en m3

        
        if ($mv >= 650 ) {//Si la masse volumique est superieure ou egale a 650kg/ligne alors le nombre de lignes = poids total / 650 
            $mes = ($product->getMetaweight() * $product->getQty())/650;

       }else{//sinon le nombre de lignes = volume total /1,700,000
            $mes = ($volumeunitaire * $product->getQty())/1700000;
       }
        //On renvoit le resultat
        return $mes;
       
    }

        // Fonction permettant de definir la mesure d'un produit dans un contexte
        private function getMesuresAir(Product $product){
        
            
            return $product->getMetaweight() * $product->getQty();
           
        }
    
    
}
