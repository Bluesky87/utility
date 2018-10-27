<?php
/**
 * Created by PhpStorm.
 * User: grzegorzkasperek
 * Date: 27.10.2018
 * Time: 18:08
 */

class RedCarBuilder implements ProductBuilderInterface
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function setName()
    {
        $this->product->name = 'SEAT';
    }

    public function setColor()
    {
       $this->product->color = 'red';
    }

    public function setType()
    {
        $this->product->type = 'sedan';
    }

    public function getResult()
    {
        return $this->product;
    }
}