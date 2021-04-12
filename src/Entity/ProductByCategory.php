<?php
namespace App\Entity;

use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;

class ProductByCategory
{
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }


    /**
     * @var ArrayCollection
     */
    private $categories;

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