<div>
    <style>
        .highlight:hover{
            background-color: #007BFF;
            color: #ffffff;
        }
    </style>
    <div class="relative">
        <div class="input-group input-group-sm">
        <input  type="text" class="form-control" 
            placeholder="Search {{$table_name}}..." wire:model="query" wire:click="queryClick" wire:keydown.escape="reset1"
            wire:keydown.arrow-up="decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
            wire:keydown.enter="selectContact" />
        </div>
        <div wire:loading class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group"
            style="position: absolute; z-index: 999;">
            <div class="list-item">Searching...</div>
        </div>
        <div class="bg-white shadow-lg" style="overflow-y: auto; max-height: 250px; position: absolute; z-index: 999; width: 90%">
            @if(!empty($contacts))
            @foreach($contacts as $i => $contact)
            <label wire:click="setData({{$contact[$search_table_id ?: 'id'] }})" style="width: 100%; cursor: pointer; font-weight: 500; font-size: 14px;"
                class="px-2 py-0 my-0 highlight {{ $highlightIndex === $i ? 'highlight' : '' }}">
                {{ $contact[$table_search_column] }}
            </label>
            <br>
            @endforeach
            @else
            @endif
        </div>
    </div>
</div>