<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubCategoryRepository::class)
 */
class SubCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SubCategoryName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SubCategoryDescription;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="subCategories")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubCategoryName(): ?string
    {
        return $this->SubCategoryName;
    }

    public function setSubCategoryName(string $SubCategoryName): self
    {
        $this->SubCategoryName = $SubCategoryName;

        return $this;
    }

    public function getSubCategoryDescription(): ?string
    {
        return $this->SubCategoryDescription;
    }

    public function setSubCategoryDescription(?string $SubCategoryDescription): self
    {
        $this->SubCategoryDescription = $SubCategoryDescription;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
