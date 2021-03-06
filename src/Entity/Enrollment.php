<?php

namespace App\Entity;

use App\Repository\EnrollmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=EnrollmentRepository::class)
 */
class Enrollment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

        /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="enrollments")
     */
    private $student;

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }


      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="enrollments")
     */
    private $course;

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
