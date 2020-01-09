<?php

namespace Tests\Unit\StringUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\StringUtils;
use Tests\Support\TestData\ClassWithToString;


class StringUtilsTest extends TestCase
{
    protected $stringUtils;

    public function setUp(): void
    {
        $this->stringUtils = new StringUtils();
    }

    public function testTrimToNull(): void
    {
        $valueForCheckWorkWithToString = new ClassWithToString("  BB   \t\t\v");
        $this->assertEquals(null, $this->stringUtils->trimToNull(''));
        $this->assertEquals('AsD', $this->stringUtils->trimToNull('  AsD     '));
        $this->assertEquals(
            'A dd', $this->stringUtils->trimToNull("  \t \n \t A dd \v\t      ")
        );
        $this->assertEquals(null, $this->stringUtils->trimToNull(null));
        $this->assertEquals(null, $this->stringUtils->trimToNull(['aa']));
        $this->assertEquals(null, $this->stringUtils->trimToNull(new \stdClass()));
        $this->assertEquals('-124434', $this->stringUtils->trimToNull(-124434));
        $this->assertEquals(0, $this->stringUtils->trimToNull(0));
        $this->assertEquals(
            'BB', $this->stringUtils->trimToNull($valueForCheckWorkWithToString)
        );
        $this->assertEquals(
            'Мама мыла раму', $this->stringUtils->trimToNull('  Мама мыла раму  ')
        );
    }

    public function testTrimToEmpty(): void
    {
        $valueForCheckWorkWithToString = new ClassWithToString("  BB   \t\t\v");
        $this->assertEquals('', $this->stringUtils->trimToEmpty(''));
        $this->assertEquals('AsD', $this->stringUtils->trimToEmpty('  AsD     '));
        $this->assertEquals(
            'A dd', $this->stringUtils->trimToEmpty("  \t \n \t A dd \v\t      ")
        );
        $this->assertEquals('', $this->stringUtils->trimToEmpty(null));
        $this->assertEquals('', $this->stringUtils->trimToEmpty(['aa']));
        $this->assertEquals('', $this->stringUtils->trimToEmpty(new \stdClass()));
        $this->assertEquals('-124434', $this->stringUtils->trimToEmpty(-124434));
        $this->assertEquals(0, $this->stringUtils->trimToEmpty(0));
        $this->assertEquals(
            'BB', $this->stringUtils->trimToEmpty($valueForCheckWorkWithToString)
        );
        $this->assertEquals(
            'Мама мыла раму', $this->stringUtils->trimToEmpty('  Мама мыла раму  ')
        );
    }

    public function testStartsWith(): void
    {
        $this->assertTrue($this->stringUtils->startsWith('Строка для поиска', 'Строка'));
        $this->assertFalse($this->stringUtils->startsWith('Строка для поиска', 'Строка  '));
        $this->assertFalse($this->stringUtils->startsWith('Строка для поиска', 'для'));
        $this->assertTrue($this->stringUtils->startsWith('Строка для поиска', ['строка', 'Строка']));
        $this->assertFalse($this->stringUtils->startsWith('Строка для поиска', ['строка']));
        $this->assertTrue($this->stringUtils->startsWith('Some string for searching', 'Some'));
        $this->assertFalse($this->stringUtils->startsWith('Some string for searching', 'Some  '));
        $this->assertFalse($this->stringUtils->startsWith('Some string for searching', 'for'));
        $this->assertTrue($this->stringUtils->startsWith('Some string for searching', ['some', 'Some']));
        $this->assertFalse($this->stringUtils->startsWith('Some string for searching', ['some']));
        $this->assertFalse($this->stringUtils->startsWith('Some string for searching', [null, new \stdClass()]));
        $this->assertTrue($this->stringUtils->startsWith('Some string for searching', 'Some string for searching'));
    }

    public function testEndsWith(): void
    {
        $this->assertTrue($this->stringUtils->endsWith('Строка для поиска', 'поиска'));
        $this->assertFalse($this->stringUtils->endsWith('Строка для поиска', '  поиска'));
        $this->assertFalse($this->stringUtils->endsWith('Строка для поиска', 'для'));
        $this->assertTrue($this->stringUtils->endsWith('Строка для поиска', ['строка', 'ска']));
        $this->assertFalse($this->stringUtils->endsWith('Строка для поиска', ['по']));
        $this->assertTrue($this->stringUtils->endsWith('Some string for searching', 'ing'));
        $this->assertFalse($this->stringUtils->endsWith('Some string for searching', 'search'));
        $this->assertFalse($this->stringUtils->endsWith('Some string for searching', 'for'));
        $this->assertFalse($this->stringUtils->endsWith('Some string for searching', ['some']));
        $this->assertFalse($this->stringUtils->endsWith('Some string for searching', [null, new \stdClass()]));
        $this->assertTrue($this->stringUtils->endsWith('Some string for searching', 'Some string for searching'));
    }

    public function testContains(): void
    {
        $this->assertTrue($this->stringUtils->contains('Строка для поиска', 'поиска'));
        $this->assertFalse($this->stringUtils->contains('Строка для поиска', '  поиска'));
        $this->assertFalse($this->stringUtils->contains('Строка для поиска', 'для   '));
        $this->assertTrue($this->stringUtils->contains('Строка для поиска', ['для', 'ска']));
        $this->assertTrue($this->stringUtils->contains('Строка для поиска', ['по']));
        $this->assertTrue($this->stringUtils->contains('Some string for searching', 'ing'));
        $this->assertFalse($this->stringUtils->contains('Some string for searching', '  search'));
        $this->assertTrue($this->stringUtils->contains('Some string for searching', 'for'));
        $this->assertFalse($this->stringUtils->contains('Some string for searching', ['some']));
        $this->assertFalse($this->stringUtils->contains('Some string for searching', [null, new \stdClass()]));
        $this->assertTrue($this->stringUtils->contains('Some string for searching', 'Some string for searching'));
    }

    public function testContainsAll(): void
    {
        $this->assertTrue($this->stringUtils->containsAll('Строка для поиска', ['поиска']));
        $this->assertFalse($this->stringUtils->containsAll('Строка для поиска', ['  поиска']));
        $this->assertFalse($this->stringUtils->containsAll('Строка для поиска', ['для   ']));
        $this->assertTrue($this->stringUtils->containsAll('Строка для поиска', ['для', 'ска']));
        $this->assertFalse($this->stringUtils->containsAll('Строка для поиска', ['для', 'ска', 'h']));
        $this->assertTrue($this->stringUtils->containsAll('Строка для поиска', ['по']));
        $this->assertTrue($this->stringUtils->containsAll('Some string for searching', ['ing']));
        $this->assertFalse($this->stringUtils->containsAll('Some string for searching', ['  search']));
        $this->assertTrue($this->stringUtils->containsAll('Some string for searching', ['for']));
        $this->assertFalse($this->stringUtils->containsAll('Some string for searching', ['some']));
        $this->assertTrue($this->stringUtils->containsAll('Some string for searching', ['Some string for searching']));
        $this->expectException(\InvalidArgumentException::class);
        $this->stringUtils->containsAll('Some string for searching', [null, new \stdClass()]);
    }

    public function testToArray(): void
    {
        $this->assertEquals(['p', 'h', 'p'], $this->stringUtils->toArray('php'));
        $this->assertEquals(['p', ' ', "\n", 'h', 'p'], $this->stringUtils->toArray("p \nhp"));
        $this->assertEquals(['п', ' ', "\n", 'Х', 'p'], $this->stringUtils->toArray("п \nХp"));
    }

    public function testStripSpace(): void
    {
        $this->assertEquals('', $this->stringUtils->stripSpace(''));
        $this->assertEquals('', $this->stringUtils->stripSpace("  \n\t\v\v\t\n "));
        $this->assertEquals('Озеро', $this->stringUtils->stripSpace("  \n\t\vОзеро\v\t\n "));
        $this->assertEquals('Lake', $this->stringUtils->stripSpace("  \n\t\vLake\v\t\n "));
        $this->assertEquals('Озеро', $this->stringUtils->stripSpace("  \n\t\vОз е\n\t\vро\v\t\n "));
    }

    public function testToLowerCase(): void
    {
        $this->assertEquals(
            "\t\vlake ontario 223_!  \n", $this->stringUtils->toLowerCase("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vозеро онтарио 223_!  \n", $this->stringUtils->toLowerCase("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', $this->stringUtils->toLowerCase(''));
    }

    public function testToLowerCaseFirst(): void
    {
        $this->assertEquals(
            "\t\vlake Ontario 223_!  \n", $this->stringUtils->toLowerCaseFirst("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vозеро Онтарио 223_!  \n", $this->stringUtils->toLowerCaseFirst("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', $this->stringUtils->toLowerCaseFirst(''));
        $this->assertEquals('john', $this->stringUtils->toLowerCaseFirst('John'));
        $this->assertEquals('джон', $this->stringUtils->toLowerCaseFirst('Джон'));
    }

    public function testToUpperCase(): void
    {
        $this->assertEquals(
            "\t\vLAKE ONTARIO 223_!  \n", $this->stringUtils->toUpperCase("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vОЗЕРО ОНТАРИО 223_!  \n", $this->stringUtils->toUpperCase("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', $this->stringUtils->toUpperCase(''));
    }

    public function testToUpperCaseFirst(): void
    {
        $this->assertEquals(
            "\t\vlake Ontario 223_!  \n", $this->stringUtils->toUpperCaseFirst("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vозеро Онтарио 223_!  \n", $this->stringUtils->toUpperCaseFirst("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', $this->stringUtils->toUpperCaseFirst(''));
        $this->assertEquals('John', $this->stringUtils->toUpperCaseFirst('john'));
        $this->assertEquals('Джон', $this->stringUtils->toUpperCaseFirst('джон'));
    }

    public function testToTitleCase(): void
    {
        $this->assertEquals(
            "\t\vLake Ontario 223_!  \n", $this->stringUtils->toTitleCase("\t\vlake Ontario 223_!  \n")
        );
        $this->assertEquals(
            "\t\vОзеро Онтарио 223_!  \n", $this->stringUtils->toTitleCase("\t\vозеро Онтарио 223_!  \n")
        );
        $this->assertEquals('', $this->stringUtils->toTitleCase(''));
    }

    public function testRand(): void
    {
        $this->assertEquals(13, mb_strlen($this->stringUtils->rand(13, 'KakaЛала123_!')));
    }
}
