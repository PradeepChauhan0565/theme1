<div>

    <button wire:click="show">Click Me</button>
    <button wire:click.prevent="openNewTab">Open New tab</button>
    {{$ctr}}
    @livewire('chetak-grid',
    [
    'headings' => $headings,
    'table'=>$table,
    'where_con'=>$where_con,
    'per_page_items' =>30,
    'per_page_item_show' =>true,
    'inline_edit' => true,
    'deletable' => true,
    'editable' => true,
    'addable' => true,
    'viewable' => true,
    'groupable' => true,
    'exportable' => ['excel'=>true,'pdf'=>true],
    'dropdown_menu' => $dropdown_menu,
    'show_checkbox' => false,
    'dragable' => true,
    'dropdown_menu' => [
    ['action'=> 'view','icon'=>'fas fa-file-download fa-lg','is_anchor'=> false,'text' => 'View'],
    ['action'=> 'test','icon'=>'fas fa-file-download fa-lg','is_anchor'=> true,'text' => 'Go to','target'=>'_blank']
    ],
    'context_menu' => [
    ['action'=> 'inlineEdit','icon'=>'fas fa-file-download fa-lg','is_anchor'=> false,'text'=>'Edit']
    ],
    'raw_query'=>$raw_query,
    'sortBy' => 'created_at',
    'grid_name' => 'first_grid',
    ],
    key('first_grid'))





    <!-- Modal Start -->
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="flex">
                <div class="bg-white px-2 text-black w-full text-xl font-bold">
                    Add/Edit Jewellery Chart
                </div>
                <div class="float-right p-2">
                    <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                        <span class="text-red-700">X</span>
                    </x-jet-secondary-button>
                </div>
            </div>
            <hr>
        </x-slot>

        <x-slot name="content">
            <div class="flex-grow">
                <div class="bg-gray-100  w-full ">
                    <div class="bg-white  rounded px-8 pt-1 pb-8 mb-4 flex flex-col">
                        <div class="-mx-3 md:flex mb-6">


                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                                    Code <span class="text-red-600 text-xl">*</span>
                                </label><br>
                                <input wire:model="jewellery_code"
                                    class="w-full  text-black border border-gray-500 rounded py-2 px-2 mb-3" type="text"
                                    maxlength="10" placeholder="Code">
                                <div class="text-red-600 text-sm">
                                    @error('jewellery_code')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                                    Inner Diameter
                                </label><br>
                                <input wire:model="inner_diameter" maxlength="9"
                                    class="w-full  text-black border border-gray-500 rounded py-2 px-2 mb-3"
                                    type="number" placeholder="Inner Diameter">
                                <div class="text-red-600 text-sm">
                                    @error('inner_diameter')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                                    Sort Index
                                </label><br>
                                <input wire:model="psctg_sort_index"
                                    class="w-full  text-black border border-gray-500 rounded py-2 px-2 mb-3"
                                    type="number">
                                <div class="text-red-600 text-sm">
                                    @error('psctg_sort_index')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            @if (!$prodsize_id)
            <button class="ml-2 mycolor py-1" wire:click="addNew()" wire:loading.attr="disabled">
                Save
            </button>
            @else
            <button class="ml-2 mycolor py-1" wire:click="updateModal({{ $prodsize_id }})" wire:loading.attr="disabled">
                Update
            </button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal End -->
    <script>
        $(document).ready(function() {           
            document.addEventListener("openNewTab", (event) => {
                window.open('hello/'+event.detail.message, '_blank');
            })
        });
    </script>
</div>