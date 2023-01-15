<?php

namespace App\Entity;

use App\Repository\TitleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TitleRepository::class)]
#[ORM\Table('titles')]
class Title
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $titleNo = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    
    #[ORM\JoinTable(name:'dept_title')]
    #[ORM\JoinColumn(name:'title_no', referencedColumnName:'title_no')]
    #[ORM\InverseJoinColumn(name:'dept_no',referencedColumnName:'dept_no')]
    #[ORM\ManyToMany(targetEntity: Department::class, inversedBy: 'titles')]
    private Collection $departments;

    public function __construct()
    {
        $this->departments = new ArrayCollection();
    }


    public function getTitleNo(): ?int
    {
        return $this->titleNo;
    }

    public function setTitleNo(int $titleNo): self
    {
        $this->titleNo = $titleNo;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->departments->contains($department)) {
            $this->departments->add($department);
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        $this->departments->removeElement($department);

        return $this;
    }
}
