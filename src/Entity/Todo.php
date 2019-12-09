<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 */
class Todo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Owner", inversedBy="todos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Owner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="Todo", orphanRemoval=true)
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?Owner
    {
        return $this->Owner;
    }

    public function setOwner(?Owner $Owner): self
    {
        $this->Owner = $Owner;

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

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setTodo($this);
        }

        return $this;
    }
    public function searchTaskInTodo(Task $task): Bool
    {
        if ($this->tasks->contains($task))
        {
            return (true);
        } else
        {
            return false;
        }
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
            // set the owning side to null (unless already changed)
            if ($task->getTodo() === $this) {
                $task->setTodo(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getTasks()->key();
    }
}
