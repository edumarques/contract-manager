<?php
declare(strict_types=1);

namespace Application\Model\Item;

use Application\Model\AbstractModel;

class Item extends AbstractModel
{
    public const CODE        = 'code';
    public const DESCRIPTION = 'description';
    public const PRICE       = 'price';

    protected ?int $code = null;

    protected ?string $description = null;

    protected ?float $price = null;


    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $instance = parent::createFromArray($data);

        if (isset($data[self::CODE])) {
            $instance->setCode($data[self::CODE]);
        }

        if (isset($data[self::DESCRIPTION])) {
            $instance->setDescription($data[self::DESCRIPTION]);
        }

        if (isset($data[self::PRICE])) {
            $instance->setPrice($data[self::PRICE]);
        }

        return $instance;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param int|null $code
     *
     * @return self
     */
    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param float|null $price
     *
     * @return self
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

}