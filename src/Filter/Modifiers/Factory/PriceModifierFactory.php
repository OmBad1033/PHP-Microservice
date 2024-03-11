<?php 
namespace App\Filter\Modifiers\Factory;


use App\Filter\Modifiers\Factory\PriceModifierFactoryInterface;
use App\Filter\Modifiers\PriceModifierInterface;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

class PriceModifierFactory implements PriceModifierFactoryInterface{

    public function create(string $modifierType):PriceModifierInterface
    {
        $modifierClassName=str_replace("_","",ucwords($modifierType,"_"));
        $modifier=self::PRICE_MODIFIER_NAMESPACE.$modifierClassName;
        if(!class_exists($modifier)){
            throw new ClassNotFoundException($modifier);
        }
        return new $modifier;
    }

}