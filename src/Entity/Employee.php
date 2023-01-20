<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\Table(name: 'employees')]
class Employee implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'emp_no', type:'integer')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(length: 14)]
    private ?string $firstName = null;

    #[ORM\Column(length: 16)]
    private ?string $lastName = null;

    #[ORM\Column(length: 1)]
    #[Assert\Choice(choices:['M', 'F', 'X'])]
    private ?string $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $hireDate = null;

    #[ORM\Column(length: 80)]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    private ?array $roles = [];

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\ManyToMany(targetEntity: Department::class, mappedBy: 'manager')]
    #[ORM\JoinColumn(name:'emp_no',referencedColumnName:'emp_no')]
    private Collection $departments;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: DeptManager::class)]
    #[ORM\JoinColumn(name:'emp_no',referencedColumnName:'emp_no')]
    private Collection $managerHistory;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: DeptEmp::class)]
    #[ORM\JoinColumn(name:'emp_no',referencedColumnName:'emp_no')]
    private Collection $employeeHistory;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Demand::class)]
    private Collection $demands;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Salary::class)]
    private Collection $salaries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hireDate = new \DateTimeImmutable();
        $this->departments = new ArrayCollection();
        $this->managerHistory = new ArrayCollection();
        $this->employeeHistory = new ArrayCollection();
        $this->demands = new ArrayCollection();
        $this->salaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hireDate;
    }

    public function setHireDate(\DateTimeInterface $hireDate): self
    {
        $this->hireDate = $hireDate;

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
            $department->addManager($this);
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        if ($this->departments->removeElement($department)) {
            $department->removeManager($this);
        }

        return $this;
    }

    public function __toString()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    /**
     * @return Collection<int, DeptManager>
     */
    public function getManagerHistory(): Collection
    {
        return $this->managerHistory;
    }

    public function addManagerHistory(DeptManager $managerHistory): self
    {
        if (!$this->managerHistory->contains($managerHistory)) {
            $this->managerHistory->add($managerHistory);
            $managerHistory->setEmployee($this);
        }

        return $this;
    }

    public function removeManagerHistory(DeptManager $managerHistory): self
    {
        if ($this->managerHistory->removeElement($managerHistory)) {
            // set the owning side to null (unless already changed)
            if ($managerHistory->getEmployee() === $this) {
                $managerHistory->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DeptEmp>
     */
    public function getEmployeeHistory(): Collection
    {
        return $this->employeeHistory;
    }

    public function addEmployeeHistory(DeptEmp $employeeHistory): self
    {
        if (!$this->employeeHistory->contains($employeeHistory)) {
            $this->employeeHistory->add($employeeHistory);
            $employeeHistory->setEmployee($this);
        }

        return $this;
    }

    public function removeEmployeeHistory(DeptEmp $employeeHistory): self
    {
        if ($this->employeeHistory->removeElement($employeeHistory)) {
            // set the owning side to null (unless already changed)
            if ($employeeHistory->getEmployee() === $this) {
                $employeeHistory->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demand>
     */
    public function getDemands(): Collection
    {
        return $this->demands;
    }

    public function addDemand(Demand $demand): self
    {
        if (!$this->demands->contains($demand)) {
            $this->demands->add($demand);
            $demand->setEmployee($this);
        }

        return $this;
    }

    public function removeDemand(Demand $demand): self
    {
        if ($this->demands->removeElement($demand)) {
            // set the owning side to null (unless already changed)
            if ($demand->getEmployee() === $this) {
                $demand->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Salary>
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addSalary(Salary $salary): self
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries->add($salary);
            $salary->setEmployee($this);
        }

        return $this;
    }

    public function removeSalary(Salary $salary): self
    {
        if ($this->salaries->removeElement($salary)) {
            // set the owning side to null (unless already changed)
            if ($salary->getEmployee() === $this) {
                $salary->setEmployee(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
    
     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
