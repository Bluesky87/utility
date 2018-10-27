<?php
/**
 * Created by PhpStorm.
 * User: grzegorzkasperek
 * Date: 27.10.2018
 * Time: 18:12
 */

class ProductDirector
{
    public function build(ProductBuilderInterface $builder)
    {
        $builder->setColor();
        $builder->setName();
        $builder->setType();

        return $builder->getResult();
    }
}