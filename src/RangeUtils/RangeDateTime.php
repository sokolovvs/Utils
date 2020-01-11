<?php


namespace Sokolovvs\Utils\RangeUtils;


use DateTimeInterface;
use InvalidArgumentException;

class RangeDateTime extends Range
{
    /* @var DateTimeInterface $from */
    protected $from;

    /* @var DateTimeInterface $to */
    protected $to;

    public function __construct(
        DateTimeInterface $from,
        DateTimeInterface $to
    ) {
        parent::__construct($from, $to);
    }

    public function isValid(): bool
    {
        return $this->from instanceof DateTimeInterface
            && $this->to instanceof DateTimeInterface
            && $this->from->getTimestamp() <= $this->to->getTimestamp();
    }

    public function valueFromIsEquivalentTo(): bool
    {
        return $this->from->getTimestamp() === $this->to->getTimestamp();
    }

    public function contains($value): bool
    {
        if (!$value instanceof DateTimeInterface) {
            throw new InvalidArgumentException('Parameter $value must be type DateTimeInterface');
        }

        return $this->getFrom()->getTimestamp() <= $value->getTimestamp()
            && $this->getTo()->getTimestamp() >= $value->getTimestamp();
    }
}
