<?php

namespace App\Entity;

use App\Entity\School;


class Student {

    private ?int $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?School $school;

    public function __construct(string $firstname = null, string $lastname = null, School $school = null, $id = null) {
        $this->firstname = $firstname;
        $this->id = $id;
        $this->lastname = $lastname;
        $this->school = $school;
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
    public function getFirstName(): string {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstName(string $firstname): void {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastName(): string {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastName(string $lastname): void {
        $this->lastname = $lastname;
    }

    /**
     * Return the school.
     * @return School|null
     */
    public function getSchool(): ?School {
        return $this->school;
    }

    /**
     * Set the school.
     * @param \App\Entity\School $school
     */
    public function setSchool(School $school): void {
        $this->school = $school;
    }
}