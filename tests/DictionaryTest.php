<?php
declare(strict_types=1);

namespace Synortix\Dictionary\Test;

use PHPUnit\Framework\TestCase;

final class DictionaryTest extends TestCase
{
    /**
     * @dataProvider dictionaryKeyProvider
     * @param $key
     * @param $value
     */
    public function testCanBeCreatedWithValidString($key, $value)
    {
        $enum = new DictionaryMock($key);

        $this->assertInstanceOf(DictionaryMock::class, $enum);
        $this->assertEquals($value, $enum->getValue());
    }

    /**
     * @dataProvider dictionaryKeyProvider
     * @param $key
     */
    public function testCanValidateKeyString($key)
    {
        $this->assertTrue(DictionaryMock::isValidKey($key));
    }

    public function dictionaryKeyProvider()
    {
        return [
            [
                'admin',
                2
            ],
            [
                'customer',
                1
            ],
            [
                'aDmIn',
                2
            ],
        ];
    }

    public function testCanBeConvertedToString()
    {
        $enum = new DictionaryMock('customer');

        $this->assertEquals('customer', (string) $enum);
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Value 'test' is not part of the dictionary Synortix\Dictionary\Test\DictionaryMock
     */
    public function testExceptionThrownForInvalidValue()
    {
        $enum = new DictionaryMock('test');

        $this->assertEquals('customer', (string) $enum);
    }
}
