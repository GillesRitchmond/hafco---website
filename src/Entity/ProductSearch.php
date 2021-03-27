<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

Class ProductSearch{
    
    /**
     * @var int|null
     */
    private $productName;

    
    /**
     * @var ArrayCollection
     */
    private $categories;

    // /**
    //  * @var ArrayCollection
    //  */
    // private $subcategories;
    

    
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        // $this->subcategories = new ArrayCollection();
    }

 
    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     */
    public function setCategories(ArrayCollection $categories): void
    {
        $this->categories = $categories;
    }

    // /**
    //  * @return ArrayCollection
    //  */
    // public function getSubCategories(): ArrayCollection
    // {
    //     return $this->subcategories;
    // }

    // /**
    //  * @param ArrayCollection $subcategories
    //  */
    // public function setSubCategories(ArrayCollection $subcategories): void
    // {
    //     $this->subcategories = $subcategories;
    // }
}