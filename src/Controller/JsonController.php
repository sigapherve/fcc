<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Checkout;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JsonController extends AbstractController
{

    /**
     * @Route("/readjson", name="app_readjson")
     */
    public function read(EntityManagerInterface $em): Array
    {
        $fichier = 'assets/'."metadata.json";

        $normalizers = [New ObjectNormalizer()];

        $encoders = [New JsonEncoder()];

        $serializer = New Serializer($normalizers,$encoders);
        
        
        //$contenufichier = ;
        
        $contenu = $serializer->decode(file_get_contents($fichier),'json');
        //dump($fichier);
        if (array_key_exists("metafields",$contenu)){
            $metafieldsproduit = $contenu["metafields"];
        }

        //dd($metafieldsproduit);
        
        $checkout = $em->getRepository(Checkout::class)->findOneby(["id"=>3]);
        //tester ici la taille du tableau en terme de nombre de produits
        $product = New Product();
        
        $product->setCheckout($checkout);


        //Explotation du resultat sous forme de tableau associatif
        for ($i=0;$i<sizeof($metafieldsproduit);$i++){
         //dump($metafieldsproduit[$i]['key']);

             if ($metafieldsproduit[$i]['key']== 'hscode'){
                $product->setName("hscode".$metafieldsproduit[$i]['value']);
            }
            if ($metafieldsproduit[$i]['key']== 'packlength'){
                $product->setMetalength($metafieldsproduit[$i]['value']);
            }
            if ($metafieldsproduit[$i]['key']== 'packwidth'){
                $product->setMetawidth($metafieldsproduit[$i]['value']);
            }
            if ($metafieldsproduit[$i]['key']== 'packheight'){
                $product->setMetaheight($metafieldsproduit[$i]['value']);
            } 
            
        }

        $product->setMetaweight(10);
        $product->setQty(25);

        //dd($product);
        
        $em->persist($product);
        $em->flush();
        //dd($product);
        dd("TERMINE-GO CHECK");
    }


    
    
}
