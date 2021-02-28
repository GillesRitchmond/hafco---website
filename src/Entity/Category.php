<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $CategoryName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CategoryDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->CategoryName;
    }

    public function setCategoryName(string $CategoryName): self
    {
        $this->CategoryName = $CategoryName;

        return $this;
    }

    public function getCategoryDescription(): ?string
    {
        return $this->CategoryDescription;
    }

    public function setCategoryDescription(?string $CategoryDescription): self
    {
        $this->CategoryDescription = $CategoryDescription;

        return $this;
    }
}
