<?php
declare(strict_types=1);

namespace Synortix\Dictionary;

use Illuminate\Contracts\Validation\Rule;
use MyCLabs\Enum\Enum;

/**
 * Class DictionaryRule
 * @package Synortix\Dictionary
 */
class DictionaryRule implements Rule
{
    /**
     * @var Enum
     */
    private $dictionary;

    public function __construct(string $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * @inheritdoc
     */
    public function passes($attribute, $value): bool
    {
        try {
            return (bool)new $this->dictionary($value);
        } catch (\UnexpectedValueException $e) {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function message(): string
    {
        $dictionary = implode(',', $this->dictionary::keys());
        return "The :attribute must be in dictionary set [$dictionary]";
    }
}
