<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
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
    private $course_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $course_description;


       /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="course", cascade={"remove"})
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

    public function getCourseName(): ?string
    {
        return $this->course_name;
    }

    public function setCourseName(string $course_name): self
    {
        $this->course_name = $course_name;

        return $this;
    }

    public function getCourseDescription(): ?string
    {
        return $this->course_description;
    }

    public function setCourseDescription(string $course_description): self
    {
        $this->course_description = $course_description;

        return $this;
    }
}
