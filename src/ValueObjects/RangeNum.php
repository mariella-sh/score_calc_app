<?php
namespace App\ValueObjects;

class RangeNum
{
    protected $number;

    protected $min = 0;
    protected $max = 0;

    public function __construct($num)
    {
        if (!in_array($num, range($this->min, $this->max))) {
            throw new \InvalidArgumentException(sprintf('"%s" number is not valid, %s', $num, get_class($this)));
        }

        $this->number = $num;
    }

    public function __toString()
    {
        return $this->number;
    }
}
