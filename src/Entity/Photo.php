<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"photo:read"}},
 *     denormalizationContext={"groups"={"photo:write"}}
 * )
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups("photo:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     *
     * @Groups({"photo:read","photo:write","annonce:read"})
     *
     */
    private $cheminPrincipal;

    /**
     * @ORM\Column(type="string", length=500)
     *
     * @Groups({"photo:read","photo:write","annonce:read"})
     */
    private $chemin;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheminPrincipal(): ?string
    {
        return $this->cheminPrincipal;
    }

    public function setCheminPrincipal(string $cheminPrincipal): self
    {
        $this->cheminPrincipal = $cheminPrincipal;

        return $this;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(string $chemin): self
    {
        $this->chemin = $chemin;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
