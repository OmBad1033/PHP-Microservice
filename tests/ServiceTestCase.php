<?php 
namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceTestCase extends WebTestCase
{
    protected ContainerInterface $container;

    protected function setUp():void
    {
        parent::setup();

        $this->container=static::createClient()->getContainer();
    }

}

