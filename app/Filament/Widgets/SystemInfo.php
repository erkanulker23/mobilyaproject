<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class SystemInfo extends Widget
{
    protected static string $view = 'filament.widgets.system-info';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function getSystemData(): array
    {
        return [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'database_size' => $this->getDatabaseSize(),
            'storage_size' => $this->getStorageSize(),
            'cache_driver' => config('cache.default'),
            'queue_driver' => config('queue.default'),
            'environment' => app()->environment(),
        ];
    }

    protected function getDatabaseSize(): string
    {
        try {
            $database = config('database.connections.' . config('database.default') . '.database');
            $result = DB::select("SELECT
                ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size
                FROM information_schema.TABLES
                WHERE table_schema = ?", [$database]);

            return ($result[0]->size ?? 0) . ' MB';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    protected function getStorageSize(): string
    {
        try {
            $path = storage_path('app/public');
            if (!is_dir($path)) {
                return '0 MB';
            }
            
            $size = 0;
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
            
            return round($size / 1024 / 1024, 2) . ' MB';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }
}

