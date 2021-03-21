<?php

namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;
use App\Calc\CalcService;

class ScoreIndexerTest extends TestCase
{
    private $data = [
        [
            'name' => 'test name',
            'gender' => 'm',
            'age' => 24,
            'region' => 'NY',
            'score' => 121,
        ],
        [
            'name' => 'test name',
            'gender' => 'm',
            'age' => 24,
            'region' => 'CA',
            'score' => 21,
        ],
        [
            'name' => 'test name2',
            'gender' => 'w',
            'age' => 56,
            'region' => 'CA',
            'score' => -7,
        ],
        [
            'name' => 'test name3',
            'gender' => 'w',
            'age' => 32,
            'region' => 'NY',
            'score' => 56,
        ],
    ];

    /**
     * @var CalcService
     */
    private $instance;

    public function testDataIndexerInterface()
    {
        $this->instance = new CalcService($this->data);

        $this->assertEquals(1, $this->instance->getCountOfUsersWithinScoreRange(20, 35));
        $this->assertEquals(2, $this->instance->getCountOfUsersWithinScoreRange(20, 100));
        $this->assertEquals(4, $this->instance->getCountOfUsersByCondition('NY', 'w', true));
        $this->assertEquals(4, $this->instance->getCountOfUsersByCondition('CA', 'm', true));
    }
}
