
    <div style="position: relative">
        <input type="text" wire:click="queryClick" 
            class="text-black border border-gray-500 px-2  w-full {{$search_class}}" style=" min-width:150px;"
            placeholder="Search results..." wire:model.debounce.500ms="query" wire:keydown.escape="reset1"
            wire:keydown.ArrowUp="decrementHighlight" wire:keydown.ArrowDown="incrementHighlight"
            wire:keydown.enter="selectresult" />
        <br>
        <div
            style="width: 200px; text-align: left; position: absolute; background-color: #fff; box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05); padding-left: 4px;">
            <div wire:loading class="list-item">Searching...</div>
        </div>
        @if(strlen($query)>=0 && $hideNoResult==null)
        <div >
        <div
            style="text-align: left; position: absolute;  background-color: #fff; box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05); z-index: 99999;">
            <div wire:loading.remove>
                @forelse($results as $i => $result)
                @if(isset($result->$table_id))
                <button style="min-width: 200px; text-align: left"
                    wire:click.prevent="resultClick('{{ $result->$table_id }}')"
                    class="pl-1 list-item {{ $highlightIndex === $i ? 'bg-gray-200' : '' }}">
                    {{ $result->$search_column_name }}
                </button>
                <br>
                @endif
                @empty
                
                @endforelse
            </div>
        </div>
    </div>
        @endif
    </div>