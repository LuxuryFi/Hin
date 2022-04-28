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
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="courses")
     */
    private $teacher;

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }


   /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enrollment", mappedBy="course", cascade={"remove"})
     */
    private $enrollments;

    public function __construct()
    {
        $this->enrollments = new ArrayCollection();
    }

    /**
     * @return Collection|Enrollment[]
     */
    public function getEnrollment(): Collection
    {
        return $this->enrollments;
    }
    

        /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="courses")
     */
    private $subject;

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
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
