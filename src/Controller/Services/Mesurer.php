<?php
namespace App\Services;

use Exception;
use App\Entity\Product;
use App\Entity\Checkout;
use Doctrine\ORM\EntityManagerInterface;

class Mesurer 
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

    }
    // Fonction permettant de definir la mesure d'un produit dans un contexte
    public function getMesures(Product $product){
        
        $mesure = 0;
        // On calcule le volume unitaire d'un article
        $volumeunitaire = $product->getMetalength() * $product->getMetawidth() * $product->getMetaheight();
        //On calcule la masse volumique de l'article formule = masse / volume
        $mv = $product->getMetaweight()/($volumeunitaire/1000000); // On divise par 1,000,000 pour ramener les valeurs en m3

        
        if ($mv >= 650 ) {//Si la masse volumique est superieure ou egale a 650 alors le nombre de lignes = poids total / 650 
            $mesure = ($product->getMetaweight() * $product->getQty())/650;

        }else{//sinon le nombre de lignes = volume/1,700,000
            $mesure = ($volumeunitaire * $product->getQty())/1700000;
        }
        //On renvoit le resultat
        return $mesure;
       
    }

    
}

