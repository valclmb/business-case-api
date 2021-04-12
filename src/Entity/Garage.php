<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 *
 *  * @ApiResource(
 *     normalizationContext={"groups"={"garage:read"}},
 *     denormalizationContext={"groups"={"garage:write"}},
 *     attributes={"security"="is_granted('ROLE_USER')"},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_USER') or object.owner == user"},
 *     }
 * )
 *
 */
class Garage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"garage:read","user:read","annonce:read","annonce:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"garage:read", "garage:write","user:read","annonce:read"})
     */
    private $nomGarage;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     * @Groups({"garage:read", "garage:write","annonce:read"})
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"garage:read", "garage:write"})
     *
     */
    private $adresseLigne1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"garage:read", "garage:write"})
     *
     */
    private $adresseLigne2;

    /**
     * @ORM\Column(type="string", length=5)
     *
     * @Groups({"garage:read", "garage:write"})
     *
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=40)
     *
     * @Groups({"garage:read", "garage:write"})
     *
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="garage")
     *
     * @Groups("garage:read")
     */
    private $annonces;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"garage:read","garage:write"})
     */
    private $user;




    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->annonces = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGarage(): ?string
    {
        return $this->nomGarage;
    }

    public function setNomGarage(string $nomGarage): self
    {
        $this->nomGarage = $nomGarage;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(?string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }



    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setGarage($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getGarage() === $this) {
                $annonce->setGarage(null);
            }
        }

        return $this;
    }

    public function getAdresseLigne1(): ?string
    {
        return $this->adresseLigne1;
    }

    public function setAdresseLigne1(string $adresseLigne1): self
    {
        $this->adresseLigne1 = $adresseLigne1;

        return $this;
    }

    public function getAdresseLigne2(): ?string
    {
        return $this->adresseLigne2;
    }

    public function setAdresseLigne2(?string $adresseLigne2): self
    {
        $this->adresseLigne2 = $adresseLigne2;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }




}
