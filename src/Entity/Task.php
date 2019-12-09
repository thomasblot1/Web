<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Todo", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Todo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Priority;

    /**
     * @ORM\Column(type="integer")
     */
    private $State;

    /**
     * @param Task $tache
     */
    public function changeState(Task $tache){
        $tache->setState(!($tache->getState()));
    }
    public function __construct()
    {
        $this->setState(true);
        $this->Date=(new \DateTime());
        $this->setPriority(1);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTodo(): ?Todo
    {
        return $this->Todo;
    }

    public function setTodo(?Todo $Todo): self
    {
        $this->Todo = $Todo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }


    public function getPriority(): ?int
    {
        return $this->Priority;
    }

    public function setPriority(?int $Priority): self
    {
        $this->Priority = $Priority;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->State;
    }

    public function setState(int $State): self
    {
        $this->State = $State;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getTodo();
    }
}
