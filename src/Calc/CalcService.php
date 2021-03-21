<?php

namespace App\Calc;

class CalcService implements ScoreDataIndexerInterface
{
    private $data;

    /**
     * CalcService constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function getCountOfUsersWithinScoreRange(int $rangeStart, int $rangeEnd): int
    {
        $set = array_filter(
            array_column($this->data, 'score'),
            function ($item) use ($rangeStart, $rangeEnd) {
                return in_array($item, range($rangeStart, $rangeEnd));
            }
        );

        return count($set);
    }

    /**
     * @inheritDoc
     */
    public function getCountOfUsersByCondition(
        string $region,
        string $gender,
        bool $hasPositiveScore
    ): int {
        $set = array_filter(
            $this->data,
            function ($item) use ($region, $gender, $hasPositiveScore) {
                return (isset($item[$region]) || isset($item[$gender]) || $item['score']);
            }
        );

        return count($set);
    }
}
