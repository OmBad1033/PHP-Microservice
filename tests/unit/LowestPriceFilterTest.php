<?php 
namespace App\Tests\unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{
    /** @test */
    public function lowest_price_promotions_filtering_is_applied_correctly():void
    {
        #given
        $lowestpriceFilter=$this->container->get(LowestPriceFilter::class);
        $enquiry=new LowestPriceEnquiry();
        $product=new Product();
        $product->setPrice(25);
       
        $enquiry->setProduct($product);
        $promotions=$this->promotionsDataProvider();
           
        #when
        $Filteredenquiry=$lowestpriceFilter->apply($enquiry,...$promotions);
        #dd($Filteredenquiry);
        
        #print($Filteredenquiry->getPromotionName()."\n");
        #print($Filteredenquiry->getAdjustment()."\n");
        #then
        print($Filteredenquiry->getPromotionName());
        print($Filteredenquiry->getAdjustment());
        $this->assertSame("first",$Filteredenquiry->getPromotionName());
        $this->assertSame(5,$Filteredenquiry->getAdjustment());
        

    }

    public function promotionsDataProvider():array
    {
        $pro1=new Promotion();
        $pro1->setName("Black");
        $pro1->setType('date_range_multiplier');
        $pro1->setAdjustment(15);
        $pro1->setCriteria(["from"=>"2022-11-25","to"=>"2022-11-28"]);

        $pro2=new Promotion();
        $pro2->setName("first");
        $pro2->setType("fixed_price");
        $pro2->setAdjustment(5);
        $pro2->setCriteria(["code"=>"2022"]);

        $pro3=new Promotion();
        $pro3->setName("Buy one get one");
        $pro3->setType("even_item_multiplier");
        $pro3->setAdjustment(25);
        $pro3->setCriteria(["minimum_quantityy"=>2]);

        return [$pro1, $pro2, $pro3];
    }

}