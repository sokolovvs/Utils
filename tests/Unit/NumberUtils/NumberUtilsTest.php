<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils;

abstract class NumberUtilsTest extends TestCase
{
    /* @var NumberUtils $numberUtils */
    protected $numberUtils;


    public function setUp(): void
    {
        $this->numberUtils = new NumberUtils();
    }
}
