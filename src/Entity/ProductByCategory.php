<?php
namespace App\Entity;

use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;

class ProductByCategory
{
    
    /**
     * @var ArrayCollection
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
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

}