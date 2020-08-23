<?php
declare(strict_types=1);

namespace Application\Model\Contract;

use Application\Model\AbstractModel;
use Application\Model\Item\Item;

class ContractItem extends AbstractModel
{
    public const QUANTITY = 'quantity';
    public const ITEM     = 'item';

    protected int $quantity = 0;

    protected ?Item $item = null;


    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $instance = parent::createFromArray($data);

        if (isset($data[self::QUANTITY])) {
            $instance->setQuantity($data[self::QUANTITY]);
        }

        if (isset($data[self::ITEM])) {
            $instance->setItem($data[self::ITEM]);
        }

        return $instance;
    }


    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


    /**
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }


    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }


    /**
     * @param Item $item
     *
     * @return self
     */
    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }


    /**
     * @return float
     */
    public function getTotalValue(): float
    {
        return $this->quantity * ($this->item ? $this->item->getPrice() ?? 0 : 0);
    }

}