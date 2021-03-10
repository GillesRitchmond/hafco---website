<?php
namespace App\Entity;

Class ProductSearch{
    
    /**
     * @var int|null
     */
    private $productName;


    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

}