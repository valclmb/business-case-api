<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"marque:read"}},
 *     denormalizationContext={"groups"={"marque:write"}}
 * )
 *

 */
class Marque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"marque:read","modele:read","annonce:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"marque:read", "marque:write","modele:read","annonce:read"})
     *
     */
    private $nomMarque;

    /**
     * @ORM\OneToMany(targetEntity=Modele::class, mappedBy="marque", orphanRemoval=true)
     *
     * @Groups("marque:read")
     */
    private $modeles;


    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMarque(): ?string
    {
        return $this->nomMarque;
    }

    public function setNomMarque(string $nomMarque): self
    {
        $this->nomMarque = $nomMarque;

        return $this;
    }

    /**
     * @return Collection|Modele[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles[] = $modele;
            $modele->setMarque($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMarque() === $this) {
                $modele->setMarque(null);
            }
        }

        return $this;
    }
}
