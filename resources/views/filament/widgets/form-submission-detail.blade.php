<div class="space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-500">Ad Soyad</p>
            <p class="mt-1 text-sm text-gray-900">{{ $record->name }}</p>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">E-posta</p>
            <p class="mt-1 text-sm text-gray-900">{{ $record->email }}</p>
        </div>
        @if($record->phone)
        <div class="col-span-2">
            <p class="text-sm font-medium text-gray-500">Telefon</p>
            <p class="mt-1 text-sm text-gray-900">{{ $record->phone }}</p>
        </div>
        @endif
    </div>
    
    @if($record->message)
    <div class="pt-4 border-t">
        <p class="text-sm font-medium text-gray-500">Mesaj</p>
        <p class="mt-2 text-sm text-gray-900 whitespace-pre-wrap">{{ $record->message }}</p>
    </div>
    @endif
    
    <div class="pt-4 border-t">
        <p class="text-sm font-medium text-gray-500">Gönderim Tarihi</p>
        <p class="mt-1 text-sm text-gray-900">{{ $record->created_at->format('d.m.Y H:i') }}</p>
    </div>
</div>

