<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

Class ProductSearch{
    
    /**
     * @var int|null
     */
    private $productName;

    // /**
    //  * @var ArrayCollection
    //  */
    // private $categoriesName;
    

    
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    // public function __construct()
    // {
    //     $this->categoriesName = new ArrayCollection();
    // }

    // /**
    //  * @@return ArrayCollection
    //  */
    // public function getCategoriesName(): ArrayCollection
    // {
    //     return $this->categoriesName;
    // }

    // /**
    //  * @param ArrayCollection $categoriesName
    //  */
    // public function setCategoriesName(ArrayCollection $categoriesName): void
    // {
    //     $this->categoriesName = $categoriesName;

    // }

    // public function getCategories(): ?category
    // {
    //     return $this->categories;
    // }

    // public function setCategories(?category $categories): self
    // {
    //     $this->categories = $categories;

    //     return $this;
    // }
}