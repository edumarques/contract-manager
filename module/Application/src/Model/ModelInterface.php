<?php
declare(strict_types=1);

namespace Application\Model;

interface ModelInterface
{
    /**
     * @param array $data
     *
     * @return static
     */
    public static function createFromArray(array $data): self;


    /**
     * @return array
     */
    public function toArray(): array;

}