<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class DebugHelpers
{
    public static function logMemoryHeader()
    {
        static::logMemory('row', ['current KB', 'peak KB']);
    }

    public static function logMemory(?string $message = null, ?array $context = null)
    {
        $context = !is_null($context) ? $context : [memory_get_usage(), memory_get_peak_usage()];
        Log::channel('memory')->debug($message, $context);
    }
}
