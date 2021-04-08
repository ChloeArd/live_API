<?php

namespace App\Entity;

class School {

    private ?int $id;
    private ?string $name;

    public function __construct(string $name = null, $id = null) {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return int|mixed|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|mixed|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }
}