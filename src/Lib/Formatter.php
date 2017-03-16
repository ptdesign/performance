<?php namespace Performance\Lib;

class Formatter {

    public function __construct()
    {
    }

    public function timeToHuman($microTime, $unit = 'auto', $decimals = 2)
    {
        // to small
        if($microTime < 0.000006)
            return '0.00';

        if($unit == "auto")
        {
            if ($microTime > 1)
                $unit = 's';
            if($microTime > 0.001)
                $unit = 'ms';
            else
                $unit = 'μs';
        }

        switch ($unit)
        {
            case 'μs':
                return round($microTime * 1000000, $decimals) . ' ' . $unit;
                break;
            case 'ms':
                return round($microTime * 1000, $decimals) . ' ' . $unit;
                break;
            case 's':
                return round($microTime * 1, $decimals) . ' ' . $unit;
                break;
            default:
                new ErrorMessage($this, 'Performance format ' . $unit . ' not exist');
        }
    }

    // Creatis to cam-gists/memoryuse.php !!
    public function memoryToHuman($bytes, $unit = "", $decimals = 2)
    {
        $units = [
            'B' => 0,
            'KB' => 1,
            'MB' => 2,
            'GB' => 3,
            'TB' => 4,
            'PB' => 5,
            'EB' => 6,
            'ZB' => 7,
            'YB' => 8
        ];

        $value = 0;
        if ($bytes > 0)
        {
            // Generate automatic prefix by bytes
            // If wrong prefix given
            if ( ! array_key_exists($unit, $units))
            {
                $pow = floor(log($bytes) / log(1024));
                $unit = array_search($pow, $units);
            }

            // Calculate byte value by prefix
            $value = ($bytes / pow(1024, floor($units[$unit])));
        }

        // If decimals is not numeric or decimals is less than 0
        if ( ! is_numeric($decimals) || $decimals < 0)
            $decimals = 2;

        // Format output
        return sprintf('%.' . $decimals . 'f ' . $unit, $value);
    }
}