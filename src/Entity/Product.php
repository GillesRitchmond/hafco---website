<?php

namespace App\Entity;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable
 */
class Product
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


     /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File|null
     * @Assert\Image(
     *  mimeTypes={"image/jpeg", "image/png", "image/jpg"})
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $image;

   
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTimeInterface|null
     */
    private $updatedAt;
  
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(min=5, max=255)
     * @var int|null
     */
    private $productName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $productDescription;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $productPrice;

    /**
     * @var string
     * @Gedmo\Slug(fields={"productName"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function getSlug(): ?string
    {
        //return (new Slugify())->slugify($this->productName);
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function setProductDescription(string $productDescription): self
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->productPrice;
    }

    public function setProductPrice(?string $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }


    public function getCategories(): ?category
    {
        return $this->categories;
    }

    public function setCategories(?category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
    
    /**
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile) :Product
    {
        $this->imageFile = $imageFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageFile instanceof UploadedFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function __toString()
    {
        return $this->productName;
    }

}
