<?php 
namespace App\Filter\Modifiers\Factory;

use App\Filter\Modifiers\PriceModifierInterface;

interface PriceModifierFactoryInterface
{
    const PRICE_MODIFIER_NAMESPACE= "App\Filter\Modifiers\\";
    public function create(string $modifierType):PriceModifierInterface;
}