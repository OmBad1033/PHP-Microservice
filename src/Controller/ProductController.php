<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Promotion;
use App\DTO\LowestPriceEnquiry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ProductRepository;
use App\Repository\PromotionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Filter\PromotionsFilterInterface;
use App\Service\Serializer\DTOSerializer;
#use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    

    public function __construct(
        private ProductRepository $repo,
        private EntityManagerInterface $entityManager,
        private PromotionRepository $promotionRepository)
    {
        
    }
    
    #[Route('/products/{id}/lowest-price', name: 'lowest-price',methods:['POST'])]
    public function lowestprice(Request $req,int $id,DTOSerializer $serializer,PromotionsFilterInterface $filter):Response
    {

      
        #1. Deserialize json data into EnquiryDTO
        $lowestprice=$serializer->deserialize($req->getContent(),LowestPriceEnquiry::class,'json');
        $product=$this->repo->find($id);#add error handling
        $lowestprice->setProduct($product);
        $promotions=$this->promotionRepository->findValidForProduct(
            $product,
            date_create_immutable($lowestprice->getRequestDate())

        );
        #dd($promotions);
        #2. Pass the Enquiry into a promotionFilter
        $modified=$filter->apply($lowestprice,...$promotions);
        #3. Return the modified Enquiry
        $responseContent=$serializer->serialize($modified,"json");
        return new Response($responseContent,200,['Content-Type'=>'application/json']);
        

    
    }
}
