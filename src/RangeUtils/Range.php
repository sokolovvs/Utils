<?php


namespace Sokolovvs\Utils\RangeUtils;


use InvalidArgumentException;
use JsonSerializable;

abstract class Range implements JsonSerializable
{
    protected $from;

    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public static function createFromArray(array $range): self
    {
        if (count($range) === 2) {
            $range = array_values($range);
            [$from, $to] = $range;

            $from = $range['from'] ?? $from;
            $to = $range['to'] ?? $to;
        } else {
            throw new InvalidArgumentException('Parameter $range must has type array and size of $range == 2');
        }

        return new static($from, $to);
    }

    abstract public function isValid(): bool;

    abstract public function valueFromIsEquivalentTo(): bool;

    abstract public function contains($value): bool;

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return ['from' => $this->getFrom(), 'to' => $this->getTo()];
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to): self
    {
        $this->to = $to;

        return $this;
    }

    public function revert(): self
    {
        $from = $this->from;
        $this->setFrom($this->getTo());
        $this->setTo($from);

        return $this;
    }
}
