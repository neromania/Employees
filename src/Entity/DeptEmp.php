<?php

namespace App\Entity;

use App\Repository\DeptEmpRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeptEmpRepository::class)]
#[ORM\Table(name:'dept_emp')]
class DeptEmp
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $empNo = null;

    #[ORM\Id]
    #[ORM\Column(length: 4)]
    private ?string $deptNo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fromDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $toDate = null;

    #[ORM\ManyToOne(inversedBy: 'employeeHistory')]
    #[ORM\JoinColumn(name:'emp_no',referencedColumnName:'emp_no',nullable: false)]
    private ?Employee $employee = null;

    public function getEmpNo(): ?int
    {
        return $this->empNo;
    }

    public function setEmpNo(int $empNo): self
    {
        $this->empNo = $empNo;

        return $this;
    }

    public function getDeptNo(): ?string
    {
        return $this->deptNo;
    }

    public function setDeptNo(string $deptNo): self
    {
        $this->deptNo = $deptNo;

        return $this;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTimeInterface $fromDate): self
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
