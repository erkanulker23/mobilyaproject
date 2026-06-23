<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-4">
            <div class="flex items-center justify-between border-b pb-2">
                <h3 class="text-lg font-semibold">Sistem Bilgileri</h3>
                <x-filament::icon 
                    icon="heroicon-o-server" 
                    class="w-6 h-6 text-gray-400"
                />
            </div>

            @php
                $systemData = $this->getSystemData();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">PHP Versiyonu</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $systemData['php_version'] }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Laravel Versiyonu</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $systemData['laravel_version'] }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Veritabanı Boyutu</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $systemData['database_size'] }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Depolama Boyutu</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $systemData['storage_size'] }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Cache Driver</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $systemData['cache_driver'] }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Queue Driver</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $systemData['queue_driver'] }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg col-span-full">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Environment</span>
                    <span class="text-sm font-semibold {{ $systemData['environment'] === 'production' ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ strtoupper($systemData['environment']) }}
                    </span>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

