<?php 
namespace App\Filter\Modifiers;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

interface PriceModifierInterface
{
    public function modify(int $price,Promotion $promotion, PromotionEnquiryInterface $enquiry):int;
    
}