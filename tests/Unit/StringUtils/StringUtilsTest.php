<?php

namespace Tests\Unit\StringUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\StringUtils\StringUtils;
use Tests\Support\TestData\ClassWithToString;


class StringUtilsTest extends TestCase
{
    public function testTrimToNull(): void
    {
        $valueForCheckWorkWithToString = new ClassWithToString("  BB   \t\t\v");
        $this->assertEquals(null, StringUtils::trimToNull(''));
        $this->assertEquals('AsD', StringUtils::trimToNull('  AsD     '));
        $this->assertEquals(
            'A dd', StringUtils::trimToNull("  \t \n \t A dd \v\t      ")
        );
        $this->assertEquals(null, StringUtils::trimToNull(null));
        $this->assertEquals(null, StringUtils::trimToNull(['aa']));
        $this->assertEquals(null, StringUtils::trimToNull(new \stdClass()));
        $this->assertEquals('-124434', StringUtils::trimToNull(-124434));
        $this->assertEquals(0, StringUtils::trimToNull(0));
        $this->assertEquals(
            'BB', StringUtils::trimToNull($valueForCheckWorkWithToString)
        );
        $this->assertEquals(
            'Мама мыла раму', StringUtils::trimToNull('  Мама мыла раму  ')
        );
    }

    public function testTrimToEmpty(): void
    {
        $valueForCheckWorkWithToString = new ClassWithToString("  BB   \t\t\v");
        $this->assertEquals('', StringUtils::trimToEmpty(''));
        $this->assertEquals('AsD', StringUtils::trimToEmpty('  AsD     '));
        $this->assertEquals(
            'A dd', StringUtils::trimToEmpty("  \t \n \t A dd \v\t      ")
        );
        $this->assertEquals('', StringUtils::trimToEmpty(null));
        $this->assertEquals('', StringUtils::trimToEmpty(['aa']));
        $this->assertEquals('', StringUtils::trimToEmpty(new \stdClass()));
        $this->assertEquals('-124434', StringUtils::trimToEmpty(-124434));
        $this->assertEquals(0, StringUtils::trimToEmpty(0));
        $this->assertEquals(
            'BB', StringUtils::trimToEmpty($valueForCheckWorkWithToString)
        );
        $this->assertEquals(
            'Мама мыла раму', StringUtils::trimToEmpty('  Мама мыла раму  ')
        );
    }

    public function testStartsWith(): void
    {
        $this->assertTrue(StringUtils::startsWith('Строка для поиска', 'Строка'));
        $this->assertFalse(StringUtils::startsWith('Строка для поиска', 'Строка  '));
        $this->assertFalse(StringUtils::startsWith('Строка для поиска', 'для'));
        $this->assertTrue(StringUtils::startsWith('Строка для поиска', ['строка', 'Строка']));
        $this->assertFalse(StringUtils::startsWith('Строка для поиска', ['строка']));
        $this->assertTrue(StringUtils::startsWith('Some string for searching', 'Some'));
        $this->assertFalse(StringUtils::startsWith('Some string for searching', 'Some  '));
        $this->assertFalse(StringUtils::startsWith('Some string for searching', 'for'));
        $this->assertTrue(StringUtils::startsWith('Some string for searching', ['some', 'Some']));
        $this->assertFalse(StringUtils::startsWith('Some string for searching', ['some']));
        $this->assertFalse(StringUtils::startsWith('Some string for searching', [null, new \stdClass()]));
        $this->assertTrue(StringUtils::startsWith('Some string for searching', 'Some string for searching'));
    }

    public function testEndsWith(): void
    {
        $this->assertTrue(StringUtils::endsWith('Строка для поиска', 'поиска'));
        $this->assertFalse(StringUtils::endsWith('Строка для поиска', '  поиска'));
        $this->assertFalse(StringUtils::endsWith('Строка для поиска', 'для'));
        $this->assertTrue(StringUtils::endsWith('Строка для поиска', ['строка', 'ска']));
        $this->assertFalse(StringUtils::endsWith('Строка для поиска', ['по']));
        $this->assertTrue(StringUtils::endsWith('Some string for searching', 'ing'));
        $this->assertFalse(StringUtils::endsWith('Some string for searching', 'search'));
        $this->assertFalse(StringUtils::endsWith('Some string for searching', 'for'));
        $this->assertFalse(StringUtils::endsWith('Some string for searching', ['some']));
        $this->assertFalse(StringUtils::endsWith('Some string for searching', [null, new \stdClass()]));
        $this->assertTrue(StringUtils::endsWith('Some string for searching', 'Some string for searching'));
    }

    public function testContains(): void
    {
        $this->assertTrue(StringUtils::contains('Строка для поиска', 'поиска'));
        $this->assertFalse(StringUtils::contains('Строка для поиска', '  поиска'));
        $this->assertFalse(StringUtils::contains('Строка для поиска', 'для   '));
        $this->assertTrue(StringUtils::contains('Строка для поиска', ['для', 'ска']));
        $this->assertTrue(StringUtils::contains('Строка для поиска', ['по']));
        $this->assertTrue(StringUtils::contains('Some string for searching', 'ing'));
        $this->assertFalse(StringUtils::contains('Some string for searching', '  search'));
        $this->assertTrue(StringUtils::contains('Some string for searching', 'for'));
        $this->assertFalse(StringUtils::contains('Some string for searching', ['some']));
        $this->assertFalse(StringUtils::contains('Some string for searching', [null, new \stdClass()]));
        $this->assertTrue(StringUtils::contains('Some string for searching', 'Some string for searching'));
    }

    public function testContainsAll(): void
    {
        $this->assertTrue(StringUtils::containsAll('Строка для поиска', ['поиска']));
        $this->assertFalse(StringUtils::containsAll('Строка для поиска', ['  поиска']));
        $this->assertFalse(StringUtils::containsAll('Строка для поиска', ['для   ']));
        $this->assertTrue(StringUtils::containsAll('Строка для поиска', ['для', 'ска']));
        $this->assertFalse(StringUtils::containsAll('Строка для поиска', ['для', 'ска', 'h']));
        $this->assertTrue(StringUtils::containsAll('Строка для поиска', ['по']));
        $this->assertTrue(StringUtils::containsAll('Some string for searching', ['ing']));
        $this->assertFalse(StringUtils::containsAll('Some string for searching', ['  search']));
        $this->assertTrue(StringUtils::containsAll('Some string for searching', ['for']));
        $this->assertFalse(StringUtils::containsAll('Some string for searching', ['some']));
        $this->assertTrue(StringUtils::containsAll('Some string for searching', ['Some string for searching']));
        $this->expectException(\InvalidArgumentException::class);
        StringUtils::containsAll('Some string for searching', [null, new \stdClass()]);
    }

    public function testToArray(): void
    {
        $this->assertEquals(['p', 'h', 'p'], StringUtils::toArray('php'));
        $this->assertEquals(['p', ' ', "\n", 'h', 'p'], StringUtils::toArray("p \nhp"));
        $this->assertEquals(['п', ' ', "\n", 'Х', 'p'], StringUtils::toArray("п \nХp"));
    }

    public function testStripSpace(): void
    {
        $this->assertEquals('', StringUtils::stripSpace(''));
        $this->assertEquals('', StringUtils::stripSpace("  \n\t\v\v\t\n "));
        $this->assertEquals('Озеро', StringUtils::stripSpace("  \n\t\vОзеро\v\t\n "));
        $this->assertEquals('Lake', StringUtils::stripSpace("  \n\t\vLake\v\t\n "));
        $this->assertEquals('Озеро', StringUtils::stripSpace("  \n\t\vОз е\n\t\vро\v\t\n "));
    }

    public function testToLowerCase(): void
    {
        $this->assertEquals(
            "\t\vlake ontario 223_!  \n", StringUtils::toLowerCase("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vозеро онтарио 223_!  \n", StringUtils::toLowerCase("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', StringUtils::toLowerCase(''));
    }

    public function testToLowerCaseFirst(): void
    {
        $this->assertEquals(
            "\t\vlake Ontario 223_!  \n", StringUtils::toLowerCaseFirst("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vозеро Онтарио 223_!  \n", StringUtils::toLowerCaseFirst("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', StringUtils::toLowerCaseFirst(''));
        $this->assertEquals('john', StringUtils::toLowerCaseFirst('John'));
        $this->assertEquals('джон', StringUtils::toLowerCaseFirst('Джон'));
    }

    public function testToUpperCase(): void
    {
        $this->assertEquals(
            "\t\vLAKE ONTARIO 223_!  \n", StringUtils::toUpperCase("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vОЗЕРО ОНТАРИО 223_!  \n", StringUtils::toUpperCase("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', StringUtils::toUpperCase(''));
    }

    public function testToUpperCaseFirst(): void
    {
        $this->assertEquals(
            "\t\vlake Ontario 223_!  \n", StringUtils::toUpperCaseFirst("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vозеро Онтарио 223_!  \n", StringUtils::toUpperCaseFirst("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', StringUtils::toUpperCaseFirst(''));
        $this->assertEquals('John', StringUtils::toUpperCaseFirst('john'));
        $this->assertEquals('Джон', StringUtils::toUpperCaseFirst('джон'));
    }

    public function testToTitleCase(): void
    {
        $this->assertEquals(
            "\t\vLake Ontario 223_!  \n", StringUtils::toTitleCase("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vОзеро Онтарио 223_!  \n", StringUtils::toTitleCase("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', StringUtils::toTitleCase(''));
    }

    public function testRand(): void
    {
        $this->assertEquals(13, mb_strlen(StringUtils::rand(13, 'KakaЛала123_!')));
        $this->assertEquals(5, mb_strlen(StringUtils::rand(5, ['f', 'f', 'ss', 'ь'])));
    }

    public function testRandWithInvalidParameterAlphabet(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectErrorMessage('Parameter alphabet must been string or array');
        StringUtils::rand(1, 4);
    }
}
