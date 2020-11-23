<?php

namespace App\Entity;

use App\Repository\OrderSetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderSetRepository::class)
 */
class OrderSet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderSets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $OrderId;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="orderSets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ArticleId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Amount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NormalPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SumPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?Order
    {
        return $this->OrderId;
    }

    public function setOrderId(?Order $OrderId): self
    {
        $this->OrderId = $OrderId;

        return $this;
    }

    public function getArticleId(): ?Article
    {
        return $this->ArticleId;
    }

    public function setArticleId(?Article $ArticleId): self
    {
        $this->ArticleId = $ArticleId;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getNormalPrice(): ?string
    {
        return $this->NormalPrice;
    }

    public function setNormalPrice(string $NormalPrice): self
    {
        $this->NormalPrice = $NormalPrice;

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
}
