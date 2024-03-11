<?php 
namespace App\Filter;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;
use App\Filter\Modifiers\PriceModifierInterface;
use App\Filter\Modifiers\Factory\PriceModifierFactoryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{
    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {

    }
    public function apply(PromotionEnquiryInterface $enquiry,Promotion ...$promotion): PromotionEnquiryInterface
    {
        $price=$enquiry->getProduct()->getPrice();
        $enquiry->setPrice($price);
        $lowestPrice=$price;
        #Loop over promotion
        foreach ($promotion as $pro){
            #run promotion modification logic aganist the enquiry
            #1. Check if promo can be applied
            #2. Apply the price modification
            $priceModifier = $this->priceModifierFactory->create($pro->getType());
            $modifiedprice=$priceModifier->modify($price,$pro,$enquiry);
            #3. check if modifiedPrice<lowestPrice
            if ($modifiedprice<$lowestPrice){
                $enquiry->setPrice($modifiedprice);
                $enquiry->setPromotionId($pro->getId());
                $enquiry->setPromotionName($pro->getName());

                $lowestPrice=$modifiedprice;
            }
        }
        return $enquiry;
    }
}