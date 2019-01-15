<?php
declare(strict_types=1);

namespace Synortix\Dictionary\Test;

use PHPUnit\Framework\TestCase;
use Synortix\Dictionary\DictionaryRule;

final class DictionaryRuleTest extends TestCase
{
    public function testValueCanBeValidatedAgainstDictionary()
    {
        $dictionaryRule = new DictionaryRule(DictionaryMock::class);

        $this->assertTrue($dictionaryRule->passes('test', 'adMin'));
        $this->assertTrue($dictionaryRule->passes('test', 'customer'));
        $this->assertFalse($dictionaryRule->passes('test', 'test'));
    }

    public function testCanReturnValidMessage()
    {
        $dictionaryRule = new DictionaryRule(DictionaryMock::class);

        $this->assertEquals('The :attribute must be in dictionary set [customer,admin]', $dictionaryRule->message());
    }
}
