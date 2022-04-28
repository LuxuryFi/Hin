<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeacherRepository::class)
 */
class Teacher
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
    private $teacher_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $teacher_description;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $teacher_summary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $teacher_gender;

    /**
     * @ORM\Column(type="boolean")
     */
    private $teacher_status;



      /**
     * @ORM\OneToMany(targetEntity="App\Entity\Course", mappedBy="teacher", cascade={"remove"})
     */
    private $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    /**
     * @return Collection|Course[]
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeacherName(): ?string
    {
        return $this->teacher_name;
    }

    public function setTeacherName(string $teacher_name): self
    {
        $this->teacher_name = $teacher_name;
        return $this;
    }

    public function getTeacherDescription(): ?string
    {
        return $this->teacher_description;
    }

    public function setTeacherDescription(string $teacher_description): self
    {
        $this->teacher_description = $teacher_description;
        return $this;
    }

    public function getTeacherSummary(): ?string
    {
        return $this->teacher_summary;
    }

    public function setTeacherSummary(string $teacher_summary): self
    {
        $this->teacher_summary = $teacher_summary;
        return $this;
    }


    public function getTeacherStatus(): ?bool
    {
        return $this->teacher_status;
    }

    public function setTeacherStatus(bool $teacher_status): self
    {
        $this->teacher_status = $teacher_status;

        return $this;
    }

    public function getTeacherGender(): ?bool
    {
        return $this->teacher_gender;
    }

    public function setTeacherGender(bool $teacher_gender): self
    {
        $this->teacher_gender = $teacher_gender;

        return $this;
    }

   
}
