<?php

namespace Modules\QualityControl\DTO\Machine;

class CreateMachineDto
{
    /**
     * @param string $title
     * @param string|null $description
     */
    public function __construct(
        private string  $title,
        private ?string $description
    )
    {
        //
    }

    /**
     * @param array $data
     * @return CreateMachineDto
     */
    public static function fromArray(array $data): CreateMachineDto
    {
        return new self(
            $data['title'],
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
}
