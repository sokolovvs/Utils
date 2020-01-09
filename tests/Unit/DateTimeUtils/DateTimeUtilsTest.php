<?php


namespace Tests\Unit\DateTimeUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils;

abstract class DateTimeUtilsTest extends TestCase
{
    /* @var DateTimeUtils $dateTimeUtils */
    protected $dateTimeUtils;

    protected function setUp(): void
    {
        $this->dateTimeUtils = new DateTimeUtils();
    }
}
