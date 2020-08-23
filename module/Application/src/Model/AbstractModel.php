<?php
declare(strict_types=1);

namespace Application\Model;

/**
 * @codeCoverageIgnore
 */
class AbstractModel implements ModelInterface
{
    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        return new static;
    }


    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

}