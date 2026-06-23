<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-4">
            <div class="flex items-center justify-between border-b pb-2">
                <h3 class="text-lg font-semibold">Hızlı Erişim</h3>
                <x-filament::icon
                    icon="heroicon-o-bolt"
                    class="w-6 h-6 text-gray-400"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($this->getLinks() as $link)
                    @php
                        $colorClasses = [
                            'primary' => 'bg-primary-100 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 hover:border-primary-500',
                            'success' => 'bg-success-100 dark:bg-success-900/20 text-success-600 dark:text-success-400 hover:border-success-500',
                            'warning' => 'bg-warning-100 dark:bg-warning-900/20 text-warning-600 dark:text-warning-400 hover:border-warning-500',
                            'info' => 'bg-info-100 dark:bg-info-900/20 text-info-600 dark:text-info-400 hover:border-info-500',
                            'danger' => 'bg-danger-100 dark:bg-danger-900/20 text-danger-600 dark:text-danger-400 hover:border-danger-500',
                            'gray' => 'bg-gray-100 dark:bg-gray-900/20 text-gray-600 dark:text-gray-400 hover:border-gray-500',
                            'purple' => 'bg-purple-100 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 hover:border-purple-500',
                        ];
                        $iconColorClass = $colorClasses[$link['color']] ?? $colorClasses['gray'];
                    @endphp
                    <a
                        href="{{ $link['url'] }}"
                        class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all duration-200 hover:scale-105 group border-2 border-transparent {{ $iconColorClass }}"
                    >
                        <div class="flex items-center justify-center w-12 h-12 mb-3 rounded-full group-hover:scale-110 transition-transform">
                            <x-filament::icon
                                :icon="$link['icon']"
                                class="w-6 h-6"
                            />
                        </div>
                        <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-center">
                            {{ $link['label'] }}
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 text-center mt-1">
                            {{ $link['description'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

