<?php

namespace App\Command;

use App\Calc\CalcService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Utils\FileCSVParser;

class CalcStatCommand extends Command
{
    protected static $defaultName = 'app:calc-stat';

    protected function configure()
    {
        $this->setDescription('Calculate stats from csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csv = [];
        try {
            $csv = (new FileCSVParser())->parseCSV();
        } catch (\Exception $e) {
            //error handler or logs writing
            $output->writeln([
                '<info>Unexpected error: </info>',
                sprintf('<info>%s</info>', $e),
            ]);
        }

        $calculator = new CalcService($csv);
        $calculator->getCountOfUsersWithinScoreRange(20, 50);
        $calculator->getCountOfUsersWithinScoreRange(-40, 0);
        $calculator->getCountOfUsersWithinScoreRange(0, 80);

        //param called legalAge removed due to object is already validated as in (1) description
        $calculator->getCountOfUsersByCondition('CA', 'w', false);
        $calculator->getCountOfUsersByCondition('CA', 'w', true);
        $calculator->getCountOfUsersByCondition('CA', 'w', true);

        return 0;
    }
}



