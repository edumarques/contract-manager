<?php
declare(strict_types=1);

namespace Application\Model\Contract;

use Application\Model\AbstractModel;
use Application\Model\Customer\Customer;

class Contract extends AbstractModel
{
    public const ID             = 'id';
    public const CUSTOMER       = 'customer';
    public const START_DATE     = 'startDate';
    public const END_DATE       = 'endDate';
    public const ISSUE_DATE     = 'issueDate';
    public const PAYMENT_METHOD = 'paymentMethod';
    public const ITEMS          = 'items';

    protected ?int $id = null;

    protected ?Customer $customer = null;

    protected ?\DateTime $startDate = null;

    protected ?\DateTime $endDate = null;

    protected ?\DateTime $issueDate = null;

    protected ?string $paymentMethod = null;

    /**
     * @var array|ContractItem[]|null
     */
    protected ?array $items = null;


    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $instance = parent::createFromArray($data);

        if (isset($data[self::ID])) {
            $instance->setId($data[self::ID]);
        }

        if (isset($data[self::CUSTOMER])) {
            $instance->setCustomer($data[self::CUSTOMER]);
        }

        if (isset($data[self::START_DATE])) {
            $instance->setStartDate($data[self::START_DATE]);
        }

        if (isset($data[self::END_DATE])) {
            $instance->setEndDate($data[self::END_DATE]);
        }

        if (isset($data[self::ISSUE_DATE])) {
            $instance->setIssueDate($data[self::ISSUE_DATE]);
        }

        if (isset($data[self::PAYMENT_METHOD])) {
            $instance->setPaymentMethod($data[self::PAYMENT_METHOD]);
        }

        if (isset($data[self::ITEMS])) {
            $instance->setItems($data[self::ITEMS]);
        }

        return $instance;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param int|null $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param Customer|null $customer
     *
     * @return self
     */
    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime|null
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param \DateTime|null $startDate
     *
     * @return self
     */
    public function setStartDate(?\DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param \DateTime|null $endDate
     *
     * @return self
     */
    public function setEndDate(?\DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime|null
     */
    public function getIssueDate(): ?\DateTime
    {
        return $this->issueDate;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param \DateTime|null $issueDate
     *
     * @return self
     */
    public function setIssueDate(?\DateTime $issueDate): self
    {
        $this->issueDate = $issueDate;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $paymentMethod
     *
     * @return self
     */
    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return ContractItem[]|array|null
     */
    public function getItems(): ?array
    {
        return $this->items;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param ContractItem[]|array|null $items
     *
     * @return self
     */
    public function setItems(?array $items): self
    {
        $this->items = $items;

        return $this;
    }


    /**
     * @return float
     */
    public function getTotalValue(): float
    {
        $totalValue = 0;

        foreach ($this->getItems() as $item) {
            $totalValue += $item->getTotalValue();
        }

        return $totalValue;
    }

}