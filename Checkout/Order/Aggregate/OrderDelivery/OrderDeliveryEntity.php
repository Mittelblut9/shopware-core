<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Order\Aggregate\OrderDelivery;

use Shopware\Core\Checkout\Cart\Price\Struct\CalculatedPrice;
use Shopware\Core\Checkout\Order\Aggregate\OrderAddress\OrderAddressEntity;
use Shopware\Core\Checkout\Order\Aggregate\OrderDeliveryPosition\OrderDeliveryPositionCollection;
use Shopware\Core\Checkout\Order\OrderEntity;
use Shopware\Core\Checkout\Shipping\ShippingMethodEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\StateMachine\Aggregation\StateMachineState\StateMachineStateStruct;

class OrderDeliveryEntity extends Entity
{
    use EntityIdTrait;
    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $shippingOrderAddressId;

    /**
     * @var string
     */
    protected $shippingMethodId;

    /**
     * @var string|null
     */
    protected $trackingCode;

    /**
     * @var \DateTime
     */
    protected $shippingDateEarliest;

    /**
     * @var \DateTime
     */
    protected $shippingDateLatest;

    /**
     * @var CalculatedPrice
     */
    protected $shippingCosts;

    /**
     * @var \DateTime|null
     */
    protected $createdAt;

    /**
     * @var \DateTime|null
     */
    protected $updatedAt;

    /**
     * @var OrderAddressEntity
     */
    protected $shippingOrderAddress;

    /**
     * @var string
     */
    protected $stateId;

    /**
     * @var StateMachineStateStruct
     */
    protected $state;

    /**
     * @var ShippingMethodEntity
     */
    protected $shippingMethod;

    /**
     * @var OrderEntity|null
     */
    protected $order;

    /**
     * @var OrderDeliveryPositionCollection|null
     */
    protected $positions;

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getShippingOrderAddressId(): string
    {
        return $this->shippingOrderAddressId;
    }

    public function setShippingOrderAddressId(string $shippingOrderAddressId): void
    {
        $this->shippingOrderAddressId = $shippingOrderAddressId;
    }

    public function getShippingMethodId(): string
    {
        return $this->shippingMethodId;
    }

    public function setShippingMethodId(string $shippingMethodId): void
    {
        $this->shippingMethodId = $shippingMethodId;
    }

    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    public function setTrackingCode(?string $trackingCode): void
    {
        $this->trackingCode = $trackingCode;
    }

    public function getShippingDateEarliest(): \DateTime
    {
        return $this->shippingDateEarliest;
    }

    public function setShippingDateEarliest(\DateTime $shippingDateEarliest): void
    {
        $this->shippingDateEarliest = $shippingDateEarliest;
    }

    public function getShippingDateLatest(): \DateTime
    {
        return $this->shippingDateLatest;
    }

    public function setShippingDateLatest(\DateTime $shippingDateLatest): void
    {
        $this->shippingDateLatest = $shippingDateLatest;
    }

    public function getShippingCosts(): CalculatedPrice
    {
        return $this->shippingCosts;
    }

    public function setShippingCosts(CalculatedPrice $shippingCosts): void
    {
        $this->shippingCosts = $shippingCosts;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getShippingOrderAddress(): OrderAddressEntity
    {
        return $this->shippingOrderAddress;
    }

    public function setShippingOrderAddress(OrderAddressEntity $shippingOrderAddress): void
    {
        $this->shippingOrderAddress = $shippingOrderAddress;
    }

    public function getShippingMethod(): ShippingMethodEntity
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(ShippingMethodEntity $shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }

    public function getOrder(): ?OrderEntity
    {
        return $this->order;
    }

    public function setOrder(OrderEntity $order): void
    {
        $this->order = $order;
    }

    public function getPositions(): ?OrderDeliveryPositionCollection
    {
        return $this->positions;
    }

    public function setPositions(OrderDeliveryPositionCollection $positions): void
    {
        $this->positions = $positions;
    }

    public function getStateId(): string
    {
        return $this->stateId;
    }

    public function setStateId(string $stateId): void
    {
        $this->stateId = $stateId;
    }

    public function getState(): StateMachineStateStruct
    {
        return $this->state;
    }

    public function setState(StateMachineStateStruct $state): void
    {
        $this->state = $state;
    }
}
