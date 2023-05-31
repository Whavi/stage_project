<?php

namespace App\Entity;

use App\Repository\FruitsMixRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitsMixRepository::class)]
class FruitsMix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $idCount = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $importAt = null;

    #[ORM\Column]
    private int $votes = 0;
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdCount(): ?int
    {
        return $this->idCount;
    }

    public function setIdCount(int $idCount): self
    {
        $this->idCount = $idCount;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getImportAt(): ?\DateTimeInterface
    {
        return $this->importAt;
    }

    public function setImportAt(\DateTimeInterface $importAt): self
    {
        $this->importAt = $importAt;

        return $this;
    }

    public function getVotes(): ?int
    {
        return $this->votes;
    }

    public function setVotes(int $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

    public function upVotes(): void{
        $this->votes++;
    }
    
    public function downVotes(): void{
        $this->votes--;
    }

    public function getVotesString(): String
    {
        $prefix = ($this->votes === 0) ? '' : (($this->votes >= 0) ? '+' : '-');
        return sprintf('%s %d', $prefix, abs($this->votes));
    }

    public function getImageUrl(int $width): string
    {
        return sprintf(
            'https://picsum.photos/id/%d/%d',
            ($this->getId() + 50) % 1000, // number between 0 and 1000, based on the id
            $width
        );
    }

    
}

