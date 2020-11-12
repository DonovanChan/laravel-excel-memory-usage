<?php

namespace App\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\NormalizerFormatter;

/**
 * Use in `formatter` argument to format message and context as csv text.
 *
 * @example
 *      logger('do', ['mi', 123])      // 'do,mi,123'
 *      logger(null, ['mi', 123])      // 'mi,123'
 *      logger('do re', ['mi', 123])   // '"do re",mi,123'
 *      logger('do re', ['mi' => 123]) // '"do re",123'
 *
 * @package App\Logging
 */
class CsvFormatter extends NormalizerFormatter implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(array $record): string
    {
        $in = parent::format($record);

        if ($message = $in['message']) {
            $out[] = $message;
        }

        foreach ($in['context'] as $key => $val) {
            $out[] = $val;
        }

        return static::arrayToCsv($out);
    }

    // Source: https://phppot.com/php/how-to-handle-csv-with-php-read-write-import-export-with-database/#how-to-convert-php-array-to-csv
    public static function arrayToCsv(?array $array, $delimiter = ',', $enclosure = '"')
    {
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $array, $delimiter, $enclosure);
        rewind($fp);
        $data = fread($fp, 1048576);
        fclose($fp);
        return $data;
    }
}
