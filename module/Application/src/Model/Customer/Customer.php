<?php
declare(strict_types=1);

namespace Application\Model\Customer;

use Application\Model\AbstractModel;

class Customer extends AbstractModel
{
    public const ID                = 'id';
    public const NAME              = 'name';
    public const STREET            = 'street';
    public const HOUSE_NUMBER      = 'houseNumber';
    public const BOROUGH           = 'borough';
    public const CITY              = 'city';
    public const ADDRESS_REFERENCE = 'addressReference';
    public const PHONE             = 'phone';
    public const MOBILE_PHONE      = 'mobilePhone';
    public const EMAIL             = 'email';

    protected ?int $id = null;

    protected ?string $name = null;

    protected ?string $street = null;

    protected ?string $houseNumber = null;

    protected ?string $borough = null;

    protected ?string $city = null;

    protected ?string $addressReference = null;

    protected ?string $phone = null;

    protected ?string $mobilePhone = null;

    protected ?string $email = null;


    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $instance = parent::createFromArray($data);

        if (isset($data[self::ID])) {
            $instance->setId($data[self::ID]);
        }

        if (isset($data[self::NAME])) {
            $instance->setName($data[self::NAME]);
        }

        if (isset($data[self::STREET])) {
            $instance->setStreet($data[self::STREET]);
        }

        if (isset($data[self::HOUSE_NUMBER])) {
            $instance->setHouseNumber($data[self::HOUSE_NUMBER]);
        }

        if (isset($data[self::BOROUGH])) {
            $instance->setBorough($data[self::BOROUGH]);
        }

        if (isset($data[self::CITY])) {
            $instance->setCity($data[self::CITY]);
        }

        if (isset($data[self::ADDRESS_REFERENCE])) {
            $instance->setAddressReference($data[self::ADDRESS_REFERENCE]);
        }

        if (isset($data[self::PHONE])) {
            $instance->setPhone($data[self::PHONE]);
        }

        if (isset($data[self::MOBILE_PHONE])) {
            $instance->setMobilePhone($data[self::MOBILE_PHONE]);
        }

        if (isset($data[self::EMAIL])) {
            $instance->setEmail($data[self::EMAIL]);
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
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $houseNumber
     */
    public function setHouseNumber(?string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getBorough(): ?string
    {
        return $this->borough;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $borough
     */
    public function setBorough(?string $borough): void
    {
        $this->borough = $borough;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getAddressReference(): ?string
    {
        return $this->addressReference;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $addressReference
     */
    public function setAddressReference(?string $addressReference): void
    {
        $this->addressReference = $addressReference;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }


    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $mobilePhone
     */
    public function setMobilePhone(?string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }


    /**
     * @codeCoverageIgnore
     *
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

}