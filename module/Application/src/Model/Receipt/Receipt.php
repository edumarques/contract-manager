<?php
declare(strict_types=1);

namespace Application\Model\Receipt;

use Application\Model\AbstractModel;
use Application\Model\Customer\Customer;

class Receipt extends AbstractModel
{
    public const CUSTOMER    = 'customer';
    public const ISSUE_DATE  = 'issueDate';
    public const AMOUNT_PAID = 'amountPaid';
    public const TOTAL_VALUE = 'totalValue';

    protected ?Customer $customer = null;

    protected ?\DateTime $issueDate = null;

    protected ?float $amountPaid = null;

    protected ?float $totalValue = null;


    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $instance = parent::createFromArray($data);

        if (isset($data[self::CUSTOMER])) {
            $instance->setCustomer($data[self::CUSTOMER]);
        }

        if (isset($data[self::ISSUE_DATE])) {
            $instance->setIssueDate($data[self::ISSUE_DATE]);
        }

        if (isset($data[self::AMOUNT_PAID])) {
            $instance->setAmountPaid($data[self::AMOUNT_PAID]);
        }

        if (isset($data[self::TOTAL_VALUE])) {
            $instance->setTotalValue($data[self::TOTAL_VALUE]);
        }

        return $instance;
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
     * @return float|null
     */
    public function getAmountPaid(): ?float
    {
        return $this->amountPaid;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param float|null $amountPaid
     *
     * @return self
     */
    public function setAmountPaid(?float $amountPaid): self
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return float|null
     */
    public function getTotalValue(): ?float
    {
        return $this->totalValue;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param float|null $totalValue
     *
     * @return self
     */
    public function setTotalValue(?float $totalValue): self
    {
        $this->totalValue = $totalValue;

        return $this;
    }


    /**
     * @return float
     */
    public function getAmountLeft(): float
    {
        $amountLeft = $this->totalValue - $this->amountPaid;

        return $amountLeft >= 0 ? $amountLeft : 0;
    }

}