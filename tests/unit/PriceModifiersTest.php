<?php
namespace App\Tests\unit;

use App\Entity\Promotion;
use App\Tests\ServiceTestCase;
use App\DTO\LowestPriceEnquiry;
use App\Filter\Modifiers\DateRangeModifier;

class PriceModifiersTest extends ServiceTestCase
{
    /** @test */
    public function DateRange_returns_a_correctly_modified_price():void
    {
        #given
        $enquiry=new LowestPriceEnquiry();
        $enquiry->setRequestDate("2022-11-30");


        $promotion=new Promotion();
        $promotion->setName("first");
        $promotion->setType("fixed");
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(["from"=>"2022-11-25","to"=>"2022-11-28"]);

        $priceModifier= new DateRangeModifier();


        #when
        $modifiedprice=$priceModifier->modify(100 ,$promotion,$enquiry); #price=100

        #then
        $this->assertEquals(50,$modifiedprice);
    }

}