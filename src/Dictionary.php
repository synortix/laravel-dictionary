<?php
declare(strict_types=1);

namespace Synortix\Dictionary;

use MyCLabs\Enum\Enum;

/**
 * Class Dictionary
 * @package Synortix\Dictionary
 */
class Dictionary extends Enum
{
    public function __construct($value)
    {
        if (is_string($value)) {
            $value = $this->fromString($value);
        }

        parent::__construct($value);
    }

    /**
     * @inheritdoc
     */
    public static function keys(): array
    {
        return array_map(function ($item) {
            return mb_strtolower($item);
        }, parent::keys());
    }

    /**
     * @inheritdoc
     */
    public static function isValidKey($key): bool
    {
        $key = mb_strtoupper($key);
        return parent::isValidKey($key);
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return (string)mb_strtolower($this->getKey());
    }

    /**
     * Returns enum key based on key string representation.
     *
     * @param string $value
     * @return mixed
     */
    protected function fromString(string $value)
    {
        if (!$this->isValidKey($value)) {
            throw new \UnexpectedValueException("Value '$value' is not part of the dictionary " . \get_called_class());
        }

        return $this->toArray()[mb_strtoupper($value)];
    }
}
