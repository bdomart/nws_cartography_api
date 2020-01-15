<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GeometryRepository")
 */
class Geometry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $coordinates = [];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Feature", mappedBy="geometry", cascade={"persist", "remove"})
     */
    private $feature;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeGeometry", inversedBy="geometries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeGeometry;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getFeature(): ?Feature
    {
        return $this->feature;
    }

    public function setFeature(?Feature $feature): self
    {
        $this->feature = $feature;

        // set (or unset) the owning side of the relation if necessary
        $newGeometry = null === $feature ? null : $this;
        if ($feature->getGeometry() !== $newGeometry) {
            $feature->setGeometry($newGeometry);
        }

        return $this;
    }

    public function getTypeGeometry(): ?TypeGeometry
    {
        return $this->typeGeometry;
    }

    public function setTypeGeometry(?TypeGeometry $typeGeometry): self
    {
        $this->typeGeometry = $typeGeometry;

        return $this;
    }
}
