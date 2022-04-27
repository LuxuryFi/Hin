<?php

namespace App\Entity;

use App\Repository\MajorRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=MajorRepository::class)
 */
class Major
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
    private $major_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $major_description;


       /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="major", cascade={"remove"})
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMajorName(): ?string
    {
        return $this->major_name;
    }

    public function setMajorName(string $major_name): self
    {
        $this->major_name = $major_name;

        return $this;
    }

    public function getMajorDescription(): ?string
    {
        return $this->major_description;
    }

    public function setMajorDescription(string $major_description): self
    {
        $this->major_description = $major_description;

        return $this;
    }
}
