<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Cart\Cart;

use Shopware\Core\Checkout\Cart\Delivery\Struct\DeliveryCollection;
use Shopware\Core\Checkout\Cart\Error\ErrorCollection;
use Shopware\Core\Checkout\Cart\Exception\LineItemNotFoundException;
use Shopware\Core\Checkout\Cart\Exception\LineItemNotRemoveableException;
use Shopware\Core\Checkout\Cart\Exception\MixedLineItemTypeException;
use Shopware\Core\Checkout\Cart\LineItem\LineItem;
use Shopware\Core\Checkout\Cart\LineItem\LineItemCollection;
use Shopware\Core\Checkout\Cart\Price\Struct\CartPrice;
use Shopware\Core\Checkout\Cart\Price\Struct\Price;
use Shopware\Core\Checkout\Cart\Tax\Struct\CalculatedTaxCollection;
use Shopware\Core\Checkout\Cart\Tax\Struct\TaxRuleCollection;
use Shopware\Core\Checkout\Cart\Transaction\Struct\TransactionCollection;
use Shopware\Core\Framework\Struct\Struct;

class Cart extends Struct
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var CartPrice
     */
    protected $price;

    /**
     * @var LineItemCollection
     */
    protected $lineItems;

    /**
     * @var ErrorCollection
     */
    protected $errors;

    /**
     * @var DeliveryCollection
     */
    protected $deliveries;

    /**
     * @var TransactionCollection
     */
    protected $transactions;

    public function __construct(string $name, string $token)
    {
        $this->name = $name;
        $this->token = $token;
        $this->lineItems = new LineItemCollection();
        $this->transactions = new TransactionCollection();
        $this->errors = new ErrorCollection();
        $this->deliveries = new DeliveryCollection();
        $this->price = new CartPrice(0, 0, 0, new CalculatedTaxCollection(), new TaxRuleCollection(), CartPrice::TAX_STATE_GROSS);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getLineItems(): LineItemCollection
    {
        return $this->lineItems;
    }

    public function setLineItems(LineItemCollection $lineItems): void
    {
        $this->lineItems = $lineItems;
    }

    public function getErrors(): ErrorCollection
    {
        return $this->errors;
    }

    public function setErrors(ErrorCollection $errors): void
    {
        $this->errors = $errors;
    }

    public function getDeliveries(): DeliveryCollection
    {
        return $this->deliveries;
    }

    public function setDeliveries(DeliveryCollection $deliveries): void
    {
        $this->deliveries = $deliveries;
    }

    /**
     * @throws MixedLineItemTypeException
     */
    public function addLineItems(LineItemCollection $lineItems): void
    {
        foreach ($lineItems as $lineItem) {
            $this->add($lineItem);
        }
    }

    public function addDeliveries(DeliveryCollection $deliveries): void
    {
        foreach ($deliveries as $delivery) {
            $this->deliveries->add($delivery);
        }
    }

    public function addErrors(ErrorCollection $errors): void
    {
        foreach ($errors as $error) {
            $this->errors->add($error);
        }
    }

    public function getPrice(): CartPrice
    {
        return $this->price;
    }

    public function setPrice(CartPrice $price): void
    {
        $this->price = $price;
    }

    /**
     * @throws MixedLineItemTypeException
     */
    public function add(LineItem $lineItem): self
    {
        $this->lineItems->add($lineItem);

        return $this;
    }

    public function get(string $lineItemKey)
    {
        return $this->lineItems->get($lineItemKey);
    }

    public function has(string $lineItemKey): bool
    {
        return $this->lineItems->has($lineItemKey);
    }

    /**
     * @throws LineItemNotFoundException
     * @throws LineItemNotRemoveableException
     */
    public function remove(string $key): void
    {
        if (!$this->has($key)) {
            throw new LineItemNotFoundException($key);
        }

        if (!$this->get($key)->isRemoveable()) {
            throw new LineItemNotRemoveableException($key);
        }

        $this->lineItems->remove($key);
    }

    public function getTransactions(): TransactionCollection
    {
        return $this->transactions;
    }

    public function setTransactions(TransactionCollection $transactions): self
    {
        $this->transactions = $transactions;

        return $this;
    }

    public function getShippingCosts(): Price
    {
        return $this->deliveries->getShippingCosts()->sum();
    }
}
