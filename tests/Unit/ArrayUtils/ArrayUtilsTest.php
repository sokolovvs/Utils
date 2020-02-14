<?php


namespace Tests\Unit\ArrayUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\ArrayUtils\ArrayUtils;

abstract class ArrayUtilsTest extends TestCase
{
    /* @var ArrayUtils $arrayUtils */
    protected $arrayUtils;

    /* @var array $randArray */
    protected $randArray;

    public function setUp(): void
    {
        $this->randArray = ArrayUtils::rand(random_int(0, 30));
    }
}
