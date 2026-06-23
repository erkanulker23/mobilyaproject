<div class="space-y-6">
    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <span class="font-semibold text-gray-700 dark:text-gray-300">Gönderim ID:</span>
            <span class="text-gray-600 dark:text-gray-400">#{{ $submission->id }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700 dark:text-gray-300">Tarih:</span>
            <span class="text-gray-600 dark:text-gray-400">{{ $submission->created_at->format('d.m.Y H:i') }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700 dark:text-gray-300">IP Adresi:</span>
            <span class="text-gray-600 dark:text-gray-400">{{ $submission->ip_address }}</span>
        </div>
        @if($submission->user)
        <div>
            <span class="font-semibold text-gray-700 dark:text-gray-300">Kullanıcı:</span>
            <span class="text-gray-600 dark:text-gray-400">{{ $submission->user->name }}</span>
        </div>
        @endif
    </div>

    <hr class="border-gray-200 dark:border-gray-700">

    <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Form Verileri</h3>

        @foreach($submission->formatted_data as $item)
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                <div class="font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ $item['label'] }}</div>
                <div class="text-gray-600 dark:text-gray-400">
                    @if(is_array($item['value']))
                        {{ implode(', ', $item['value']) }}
                    @elseif($item['type'] === 'file' || $item['type'] === 'image')
                        <a href="{{ Storage::url($item['value']) }}" target="_blank" class="text-primary-600 hover:underline">
                            Dosyayı Görüntüle
                        </a>
                    @else
                        {{ $item['value'] }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if($submission->notes)
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Notlar</h3>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4">
            <p class="text-gray-700 dark:text-gray-300">{{ $submission->notes }}</p>
        </div>
    </div>
    @endif
</div>

