<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffiliateRepository")
 * @ORM\Table(name="affiliates")
 * @ORM\HasLifecycleCallbacks()
 */
class Affiliate
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
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="affiliateId")
     * @ORM\JoinTable(name="affiliates_categories")
     */
    private $categoryId;

    public function __construct()
    {
        $this->categoryId = new ArrayCollection();
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Affiliate
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Affiliate
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Affiliate
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Affiliate
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Affiliate
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategoryId(): Collection
    {
        return $this->categoryId;
    }

    /**
     * @param Category $categoryId
     * @return Affiliate
     */
    public function addCategoryId(Category $categoryId): self
    {
        if (!$this->categoryId->contains($categoryId)) {
            $this->categoryId[] = $categoryId;
            $categoryId->addAffiliateId($this);
        }

        return $this;
    }

    /**
     * @param Category $categoryId
     * @return Affiliate
     */
    public function removeCategoryId(Category $categoryId): self
    {
        if ($this->categoryId->contains($categoryId)) {
            $this->categoryId->removeElement($categoryId);
            $categoryId->removeAffiliateId($this);
        }

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }
}
