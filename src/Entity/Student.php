<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
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
    private $student_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_description;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_summary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $student_gender;

    /**
     * @ORM\Column(type="boolean")
     */
    private $student_status;



      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Major", inversedBy="students")
     */
    private $major;

    public function getMajor(): ?Major
    {
        return $this->major;
    }

    public function setMajor(?Major $major): self
    {
        $this->major = $major;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentName(): ?string
    {
        return $this->student_name;
    }

    public function setStudentName(string $student_name): self
    {
        $this->student_name = $student_name;
        return $this;
    }

    public function getStudentDescription(): ?string
    {
        return $this->student_description;
    }

    public function setStudentDescription(string $student_description): self
    {
        $this->student_description = $student_description;
        return $this;
    }

    public function getStudentSummary(): ?string
    {
        return $this->student_summary;
    }

    public function setStudentSummary(string $student_summary): self
    {
        $this->student_summary = $student_summary;
        return $this;
    }


    public function getStudentStatus(): ?bool
    {
        return $this->student_status;
    }

    public function setStudentStatus(bool $student_status): self
    {
        $this->student_status = $student_status;

        return $this;
    }

    public function getStudentGender(): ?bool
    {
        return $this->student_gender;
    }

    public function setStudentGender(bool $student_gender): self
    {
        $this->student_gender = $student_gender;

        return $this;
    }

   
}
