<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EssaiJsonController extends AbstractController
{
    /**
     * @Route("/test", name="app_essai_json")
     */
    public function test(SerializerInterface $serializer){
        //$path = $packages->getUrl('public/assets/json');
        $path = $this->getParameter('targetDirectory');
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($path);

        // check if there are any search results
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                
                $data = $file->getContents();

            
            }
            
        }       

        //dd($data);
       $data2 = json_decode($data);
        
        //$product = $serializer->deserialize($data, Product::class, 'json');
        dd($data2);
        //dd ($product);
     }
}
