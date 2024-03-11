<?php 
namespace App\Filter\Modifiers;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class FixedPrice implements PriceModifierInterface
{
    public function modify(int $price, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        if (!($enquiry->getCode()=== $promotion->getCriteria()['code']))
        {
            return $price;
        }
        return $price*$promotion->getAdjustment();
    }
}