<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class DebugHelpers
{
    public static function logMemoryHeader(): void
    {
        static::logMemory('row', ['current KB', 'peak KB']);
    }

    public static function logMemory(?string $message = null, ?array $context = null): void
    {
        $context = !is_null($context) ? $context : [memory_get_usage()/1024, memory_get_peak_usage()/1024];
        Log::channel('memory')->debug($message, $context);
    }
}
