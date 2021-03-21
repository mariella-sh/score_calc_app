<?php

namespace App\Utils;

use App\Model\DataSet;
use App\ValueObjects\Age;
use App\ValueObjects\Score;
use Symfony\Component\Finder\Finder;

class FileCSVParser
{

    private const KEYS = [
        'name',
        'gender',
        'age',
        'region',
        'score',
    ];

    private $csvParsingOptions = [
        'finder_in' => 'resources',
        'finder_name' => 'dataset.csv',
        'ignoreFirstLine' => true,
    ];

    /**
     * Parse a csv file
     *
     * @return array
     * @throws \Exception
     */
    public function parseCSV()
    {
        $ignoreFirstLine = $this->csvParsingOptions['ignoreFirstLine'];

        $finder = new Finder();
        $finder->files()
            ->in($this->csvParsingOptions['finder_in'])
            ->name($this->csvParsingOptions['finder_name']);
        foreach ($finder as $file) {
            $csv = $file;
        }

        $rows = array();
        if (($handle = fopen($csv->getRealPath(), "r")) !== false) {
            $i = 0;
            while (($data = fgetcsv($handle, null, ";")) !== false) {
                $i++;
                if ($ignoreFirstLine && $i == 1) {
                    continue;
                }

                try {
                    $result = array_combine(self::KEYS, $data);
                    $rows[] = (new DataSet(
                        $result['name'],
                        $result['gender'],
                        (new Age($result['age']))->__toString(),
                        $result['region'],
                        (new Score($result['score']))->__toString()
                    ))->__toArray();
                } catch (\Exception $e) {
                    //this should be an error handler
                    echo sprintf('[Error] While processing item #%d occurred: %s',$i , $e);
                    continue;
                }
            }

            fclose($handle);
        }
        var_dump($rows); die;
        return $rows;
    }
}
