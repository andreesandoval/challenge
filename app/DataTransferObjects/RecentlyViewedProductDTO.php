<?php

namespace App\DataTransferObjects;

use JsonSerializable;

class RecentlyViewedProductDTO implements JsonSerializable
{

    private $id;

    private $userId;

    private $productDTO;

    private $viewedAt;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setProduct(ProductDTO $productDTO): self
    {
        $this->productDTO = $productDTO;
        return $this;
    }

    public function getProduct(): ProductDTO
    {
        return $this->productDTO;
    }

    public function setViewedAt(string $viewedAt): self
    {
        $this->viewedAt = $viewedAt;
        return $this;
    }

    public function getViewedAt(): string
    {
        return $this->viewedAt;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->productDTO->getId(),
            'name' => $this->productDTO->getName(),
            'description' => $this->productDTO->getDescription()
        ];
    }
}
