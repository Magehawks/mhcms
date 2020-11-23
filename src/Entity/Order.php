<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SumPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=OrderSet::class, mappedBy="OrderId", orphanRemoval=true)
     */
    private $orderSets;

    public function __construct()
    {
        $this->orderSets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getSumPrice(): ?string
    {
        return $this->SumPrice;
    }

    public function setSumPrice(string $SumPrice): self
    {
        $this->SumPrice = $SumPrice;

        return $this;
    }

    /**
     * @return Collection|OrderSet[]
     */
    public function getOrderSets(): Collection
    {
        return $this->orderSets;
    }

    public function addOrderSet(OrderSet $orderSet): self
    {
        if (!$this->orderSets->contains($orderSet)) {
            $this->orderSets[] = $orderSet;
            $orderSet->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderSet(OrderSet $orderSet): self
    {
        if ($this->orderSets->removeElement($orderSet)) {
            // set the owning side to null (unless already changed)
            if ($orderSet->getOrderId() === $this) {
                $orderSet->setOrderId(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
