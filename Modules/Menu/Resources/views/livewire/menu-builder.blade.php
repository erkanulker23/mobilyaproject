
<div>
    <form wire:submit="save" x-data="{
        data: $wire.entangle('data'),
        sortables: [],
        getDataStructure(parentNode) {
          const items = Array.from(parentNode.children).filter((item) => {
            return item.classList.contains('item');
          }); // Get children items of the current node

          return Array.from(items).map((item) => {
            const id = item.getAttribute('data-id');
            const nestedContainer = item.querySelector('.nested');
            const children = nestedContainer ? this.getDataStructure(nestedContainer): [];

            return { id: parseInt(id), children };
          });
        }
    }"
    x-on:menu-item-created.window="() => {
        console.log('menu-item-created');
    }"
    >
        <div class="nested-wrapper">
            <div id="parentNested" class="nested"
                 x-data="{
                    init(){
                        new Sortable(this.$el, {
                            group: 'nested',
                            animation: 150,
                            fallbackOnBody: true,
                            swapThreshold: 0.65,
                            onEnd: (evt) => {
                                this.data = getDataStructure(document.getElementById('parentNested'));
                            }
                        })
                    },
                }">
                @foreach($items as $item)
                    @include('menu::livewire.menu-item', ['item' => $item])
                @endforeach
            </div>
        </div>
        @if($items->count() > 0)
            <x-filament::button
                :dark-mode="config('filament.dark_mode')"
                wire:loading.attr="disabled"
                type="submit"
                class="mt-2"
            >
                <x-filament::loading-indicator wire:loading class="h-5 w-5" />
                Kaydet
            </x-filament::button>
            <p>
                Sırasını değiştirdiğiniz menü öğeleri otomatik olarak kaydedilmez. Kaydet butonuna basarak değişiklikleri kaydedebilirsiniz.
            </p>
        @else
            <div class="text-gray-500 text-center">
                Henüz bir menü öğesi eklenmedi. <br> Soldaki menüyü kullanarak menü öğeleri ekleyebilirsiniz.
            </div>
        @endif
    </form>






    <x-filament-actions::modals />
    <style>
        .nested > .item {
            margin-top: 15px;
        }

        .nested > .item > .nested {
            padding: 10px;
            background: rgba(0, 0, 0, 0.02);
            margin-left: 15px;
            border-radius: 5px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .nested-wrapper {
            padding: 0 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .nested .nested {
            padding: 8px 0;
            margin-left: 15px;
        }
    </style>

</div>
