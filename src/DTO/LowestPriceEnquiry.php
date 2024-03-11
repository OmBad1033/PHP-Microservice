<?php 
namespace App\DTO;

use App\Entity\Product;
use Symfony\Component\Serializer\Annotation\Ignore;

class LowestPriceEnquiry implements PromotionEnquiryInterface
{
    #[Ignore]
    private ?Product $product;
    private ?int $price;
    private ?string $requestDate;
    private ?string $promotion_name;
    private ?int $promotion_id;
    private ?int $adjustment;
    private ?string $valid;
    private ?string $code;

    /**
     * Get the value of price
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of promotion_name
     */
    public function getPromotionName(): ?string
    {
        return $this->promotion_name;
    }

    /**
     * Set the value of promotion_name
     */
    public function setPromotionName(?string $promotion_name): self
    {
        $this->promotion_name = $promotion_name;

        return $this;
    }

    /**
     * Get the value of promotion_id
     */
    public function getPromotionId(): ?int
    {
        return $this->promotion_id;
    }

    /**
     * Set the value of promotion_id
     */
    public function setPromotionId(?int $promotion_id): self
    {
        $this->promotion_id = $promotion_id;

        return $this;
    }

    /**
     * Get the value of adjustment
     */
    public function getAdjustment(): ?int
    {
        return $this->adjustment;
    }

    /**
     * Set the value of adjustment
     */
    public function setAdjustment(?int $adjustment): self
    {
        $this->adjustment = $adjustment;

        return $this;
    }

    /**
     * Get the value of valid
     */
    public function getValid(): ?string
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     */
    public function setValid(?string $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get the value of product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get the value of requestDate
     */
    public function getRequestDate(): ?string
    {
        return $this->requestDate;
    }

    /**
     * Set the value of requestDate
     */
    public function setRequestDate(?string $requestDate): self
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set the value of code
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }
   }