<?php
/**
 * Created by PhpStorm.
 * User: grzegorzkasperek
 * Date: 27.10.2018
 * Time: 18:07
 */

interface ProductBuilderInterface
{
    public function setName();

    public function setColor();

    public function setType();

    public function getResult();
}