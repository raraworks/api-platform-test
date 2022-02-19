<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Index(columns: ["sku"], name: "idx_product_sku")]
#[ORM\Index(columns: ["slug"], name: "idx_product_slug")]
class Product
{
    /**
     * @var string|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', unique: true)]
    private string|null $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string|null $sku = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 500)]
    private string|null $title = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 500)]
    private string|null $slug = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'text', nullable: true)]
    private string|null $description = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $imageFile = null;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface|null $createdAt = null;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface|null $updatedAt = null;

    /**
     * @return string|null
     */
    public function getId(): string|null
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSku(): string|null
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     * @return $this
     */
    public function setSku(string|null $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): string|null
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(string|null $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): string|null
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return $this
     */
    public function setSlug(string|null $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): string|null
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(string|null $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageFile(): string|null
    {
        return $this->imageFile;
    }

    /**
     * @param string|null $imageFile
     * @return $this
     */
    public function setImageFile(string|null $imageFile): self
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): DateTimeInterface|null
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface|null $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): DateTimeInterface|null
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTimeInterface|null $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
