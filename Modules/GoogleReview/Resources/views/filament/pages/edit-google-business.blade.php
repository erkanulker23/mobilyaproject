<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament-panels::form wire:submit="save">
            {{ $this->form }}

            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        </x-filament-panels::form>

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Yorumlar</h2>
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>

