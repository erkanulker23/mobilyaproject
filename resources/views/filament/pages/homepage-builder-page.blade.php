<div>
    <form wire:submit="submit" style="margin-top:50px">
        {{ $this->form }}

        <x-filament::button
            :dark-mode="config('filament.dark_mode')"
            wire:loading.attr="disabled"
            type="submit"
        >
            Kaydet
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
