<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
#[ORM\Table(name: 'departments')]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: '`dept_no`', type: 'string')]
    private ?string $id = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $deptName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $roiUrl = null;

    #[ORM\JoinTable(name:'dept_manager')]
    #[ORM\JoinColumn(name:'dept_no',referencedColumnName:'dept_no')]
    #[ORM\InverseJoinColumn(name:'emp_no', referencedColumnName:'emp_no')]
    #[ORM\ManyToMany(targetEntity: Employee::class, inversedBy: 'departments')]
    private Collection $manager;

    #[ORM\JoinTable(name:'dept_emp')]
    #[ORM\JoinColumn(name:'dept_no',referencedColumnName:'dept_no')]
    #[ORM\InverseJoinColumn(name:'emp_no', referencedColumnName:'emp_no')]
    #[ORM\ManyToMany(targetEntity: Employee::class, inversedBy: 'employeesTab')]
    private Collection $employees;

    public function __construct()
    {
        $this->manager = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDeptName(): ?string
    {
        return $this->deptName;
    }

    public function setDeptName(string $deptName): self
    {
        $this->deptName = $deptName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRoiUrl(): ?string
    {
        return $this->roiUrl;
    }

    public function setRoiUrl(?string $roiUrl): self
    {
        $this->roiUrl = $roiUrl;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getManager(): Collection
    {
        return $this->manager;
    }

    public function addManager(Employee $manager): self
    {
        if (!$this->manager->contains($manager)) {
            $this->manager->add($manager);
        }

        return $this;
    }

    public function removeManager(Employee $manager): self
    {
        $this->manager->removeElement($manager);

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        $this->employees->removeElement($employee);

        return $this;
    }

}
