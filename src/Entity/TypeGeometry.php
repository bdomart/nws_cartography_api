<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeGeometryRepository")
 */
class TypeGeometry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $coordinateNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Geometry", mappedBy="typeGeometry")
     */
    private $geometries;

    public function __construct()
    {
        $this->geometries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCoordinateNumber(): ?int
    {
        return $this->coordinateNumber;
    }

    public function setCoordinateNumber(?int $coordinateNumber): self
    {
        $this->coordinateNumber = $coordinateNumber;

        return $this;
    }

    /**
     * @return Collection|Geometry[]
     */
    public function getGeometries(): Collection
    {
        return $this->geometries;
    }

    public function addGeometry(Geometry $geometry): self
    {
        if (!$this->geometries->contains($geometry)) {
            $this->geometries[] = $geometry;
            $geometry->setTypeGeometry($this);
        }

        return $this;
    }

    public function removeGeometry(Geometry $geometry): self
    {
        if ($this->geometries->contains($geometry)) {
            $this->geometries->removeElement($geometry);
            // set the owning side to null (unless already changed)
            if ($geometry->getTypeGeometry() === $this) {
                $geometry->setTypeGeometry(null);
            }
        }

        return $this;
    }
}
