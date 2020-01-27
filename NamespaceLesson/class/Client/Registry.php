<?php

namespace Client;

class Registry extends \Registry
{
    public function registerSale()
    {
            return "Foi registrada uma compra para o cliente: {$this->getName()}";
    }
}