<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

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

    // /**
    //  * @var string
    //  * @Gedmo\Slug(fields={"categoryName"})
    //  * 
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $slug;

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

    // public function getSlug(): ?string
    // {
    //     //return (new Slugify())->slugify($this->productName);
    //     return $this->slug;
    // }

    // public function setSlug(string $slug): self
    // {
    //     $this->slug = $slug;

    //     return $this;
    // } 
}
