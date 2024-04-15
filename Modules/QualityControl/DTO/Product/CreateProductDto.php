<?php

namespace Modules\QualityControl\DTO\Product;

class CreateProductDto
{
    /**
     * @param string $title
     * @param string|null $weight
     * @param string|null $description
     */
    public function __construct(
        private string  $title,
        private ?string $weight,
        private ?string $description
    )
    {
        //
    }

    /**
     * @param array $data
     * @return CreateProductDto
     */
    public static function fromArray(array $data): CreateProductDto
    {
        return new self(
            $data['title'],
            $data['weight'] ?? null,
            $data['description'] ?? null
        );
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }
}
