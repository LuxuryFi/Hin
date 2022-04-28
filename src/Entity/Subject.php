<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 */
class Subject
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
    private $subject_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject_description;


    
       /**
     * @ORM\OneToMany(targetEntity="App\Entity\Course", mappedBy="subject", cascade={"remove"})
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

    public function getSubjectName(): ?string
    {
        return $this->subject_name;
    }

    public function setSubjectName(string $subject_name): self
    {
        $this->subject_name = $subject_name;

        return $this;
    }

    public function getSubjectDescription(): ?string
    {
        return $this->subject_description;
    }

    public function setSubjectDescription(string $subject_description): self
    {
        $this->subject_description = $subject_description;

        return $this;
    }
}
