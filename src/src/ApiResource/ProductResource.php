<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;

#[ApiResource]
class ProductResource
{
    /**
     * @param string|null $id
     * @param string|null $sku
     * @param string|null $title
     * @param string|null $slug
     * @param string|null $description
     * @param string|null $imageFile
     * @param DateTimeInterface|null $createdAt
     * @param DateTimeInterface|null $updatedAt
     */
    public function __construct(
        private string|null            $id = null,
        private string|null            $sku = null,
        private string|null            $title = null,
        private string|null            $slug = null,
        private string|null            $description = null,
        private string|null            $imageFile = null,
        private DateTimeInterface|null $createdAt = null,
        private DateTimeInterface|null $updatedAt = null,
    )
    {
    }

    /**
     * @return string|null
     */
    public function getId(): string|null
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(string|null $id): void
    {
        $this->id = $id;
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
     */
    public function setSku(string|null $sku): void
    {
        $this->sku = $sku;
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
     */
    public function setTitle(string|null $title): void
    {
        $this->title = $title;
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
     */
    public function setSlug(string|null $slug): void
    {
        $this->slug = $slug;
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
     */
    public function setDescription(string|null $description): void
    {
        $this->description = $description;
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
     */
    public function setCreatedAt(DateTimeInterface|null $createdAt): void
    {
        $this->createdAt = $createdAt;
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
     */
    public function setUpdatedAt(DateTimeInterface|null $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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
     */
    public function setImageFile(string|null $imageFile): void
    {
        $this->imageFile = $imageFile;
    }
}