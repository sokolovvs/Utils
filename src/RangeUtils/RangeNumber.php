<?php


namespace Sokolovvs\Utils\RangeUtils;


use InvalidArgumentException;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class RangeNumber extends Range
{
    /* @var int|float|double $from */
    protected $from;

    /* @var int|float|double $to */
    protected $to;

    /**
     * RangeNumber constructor.
     *
     * @param float|int|double|string $from
     * @param float|int|double|string $to
     */
    public function __construct($from, $to)
    {
        parent::__construct($from, $to);
        $this->filterCreateParameters($from, $to);
    }

    public function isValid(): bool
    {
        return is_numeric($this->from) && is_numeric($this->to) && $this->from <= $this->to;
    }

    public function valueFromIsEquivalentTo(): bool
    {
        return $this->from == $this->to;
    }

    public function contains($value): bool
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException('Parameter $value must be type float or double or integer');
        }

        return $this->getFrom() <= $value && $this->getTo() >= $value;
    }

    private function filterCreateParameters($from, $to): void
    {
        if (!is_numeric($this->getFrom()) || !is_numeric($this->getTo())) {
            throw new InvalidArgumentException('Parameters $from and $to must be numeric');
        }

        $this->setFrom($from)
            ->setTo($to);
    }
}
