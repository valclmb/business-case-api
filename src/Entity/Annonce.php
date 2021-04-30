<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 *
 * @ApiResource(
 *     attributes={"order"={"id":"DESC"}},
 *     normalizationContext={"groups"={"annonce:read"}},
 *     denormalizationContext={"groups"={"annonce:write"}}
 *
 * )
 */
class Annonce
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"annonce:read","garage:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"annonce:read","annonce:write","garage:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $typeCarburant;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $reference;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"annonce:read","annonce:write"})
     *
     */
    private $couleur;


    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"annonce:read","annonce:write"})
     *
     */
    private $etatVehicule;


    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="annonces")
     *
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="annonces")
     *
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"annonce:read","annonce:write"})
     */
    private $garage;


    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="annonce", orphanRemoval=true)
     *
     *@Groups({"annonce:read","annonce:write"})
     */
    private $photos;


    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->etatVehicules = new ArrayCollection();
        $this->couleurs = new ArrayCollection();
        $this->garages = new ArrayCollection();
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTypeCarburant(): ?bool
    {
        return $this->typeCarburant;
    }

    public function setTypeCarburant(bool $typeCarburant): self
    {
        $this->typeCarburant = $typeCarburant;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }




    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }




    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getEtatVehicule(): ?string
    {
        return $this->etatVehicule;
    }

    public function setEtatVehicule(string $etatVehicule): self
    {
        $this->etatVehicule = $etatVehicule;

        return $this;
    }


    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAnnonce($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getAnnonce() === $this) {
                $photo->setAnnonce(null);
            }
        }

        return $this;
    }
}
