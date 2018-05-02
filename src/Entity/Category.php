<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Job", mappedBy="categoryId")
     */
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Affiliate", inversedBy="categoryId")
     * @ORM\JoinTable(name="affiliates_categories")
     */
    private $affiliateId;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->affiliateId = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    /**
     * @param Job $job
     * @return Category
     */
    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCategoryId($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
        }

        return $this;
    }

    /**
     * @return Collection|Affiliate[]
     */
    public function getAffiliateId(): Collection
    {
        return $this->affiliateId;
    }

    public function addAffiliateId(Affiliate $affiliateId): self
    {
        if (!$this->affiliateId->contains($affiliateId)) {
            $this->affiliateId[] = $affiliateId;
        }

        return $this;
    }

    public function removeAffiliateId(Affiliate $affiliateId): self
    {
        if ($this->affiliateId->contains($affiliateId)) {
            $this->affiliateId->removeElement($affiliateId);
        }

        return $this;
    }
}
