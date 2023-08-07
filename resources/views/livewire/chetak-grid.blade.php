<div wire:id="{{$chetak_grid_name}}" @if(!$grid_selected) class="" @endif>


    <div class="root p-2" @if($grid_selected) style="background-color: rgb(192, 192, 174)" @else
        style="background-color: white)" @endif>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
            integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style type="text/css">
            .dropdown-grid {
                /* visibility: hidden; */
                margin-left: 10%;

            }

            .dropdown-content-grid {
                z-index: 100;
                position: absolute;
            }

            .show-filter {
                visibility: hidden;
            }

            .filter:hover .show-filter {
                visibility: visible;
                transition: 0.3s;
            }

            .context-menu {
                position: absolute;
                background-color: #ffffff;
                box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.2);
                padding: 15px;
                border-left: 1px;
                border-top: 1px;
            }

            .context-menu ul {
                padding: 0px;
                margin: 0px;
                min-width: 150px;
                list-style: none;
            }

            .context-menu ul li {
                padding: 2px 5px;
            }

            .context-menu ul li button {
                text-decoration: none;
                color: black;
                font-size: 13px;
            }

            .context-menu ul li:hover {
                background: rgb(230, 230, 230);
            }

            table {
                width: 100% !important;
            }



            .tr-hover:hover {
                background-color: rgb(253, 253, 227);
            }

            .tr-selected {
                background-color: rgb(253, 253, 227);
            }

            .parent {
                height: 300px;
                width: 300px;
                position: relative;
            }

            .child {
                width: 100px;
                height: 100px;
                position: absolute;
                top: 50%;
                left: 55%;
                margin: -50px 0 0 -50px;
            }

            .w-full {
                width: 100% !important;
            }

            .overflow-hidden {
                overflow: hidden !important;
            }

            .shadow-xs {
                box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
            }

            .bg-gray-400 {
                --bg-opacity: 1;
                background-color: #9fa6b2;
                background-color: rgba(159, 166, 178, var(--bg-opacity));
            }

            .border-gray-600 {
                --border-opacity: 1;
                border-color: #4b5563;
                border-color: rgba(75, 85, 99, var(--border-opacity));
            }

            .text-xs {
                font-size: 0.75rem
                    /* 12px */
                ;
            }

            .font-semibold {
                font-weight: 600;
            }

            .tracking-wide {
                letter-spacing: 0.025em;
            }

            .text-left {
                text-align: left;
            }

            .uppercase {
                text-transform: uppercase;
            }

            .pl-2 {
                padding-left: 0.5rem
                    /* 8px */
                ;
            }

            .pr-4 {
                padding-right: 1rem
                    /* 16px */
                ;
            }

            .text-sm {
                font-size: 0.875rem
                    /* 14px */
                ;
            }

            .text-gray-800 {
                --text-opacity: 1;
                color: #252f3f;
                color: rgba(37, 47, 63, var(--text-opacity));
            }

            .border {
                border-width: 1px;
            }

            .px-0\.5 {
                padding-left: 0.125rem
                    /* 2px */
                ;
                padding-right: 0.125rem
                    /* 2px */
                ;
            }

            .px-2 {
                padding-left: 0.5rem
                    /* 8px */
                ;
                padding-right: 0.5rem
                    /* 8px */
                ;
            }

            .py-1 {
                padding-top: 0.25rem
                    /* 4px */
                ;
                padding-bottom: 0.25rem
                    /* 4px */
                ;
            }

            .flex {
                display: flex;
            }

            .cursor-pointer {
                cursor: pointer;
            }

            .mx-1 {
                margin-left: 0.25rem
                    /* 4px */
                ;
                margin-right: 0.25rem
                    /* 4px */
                ;
            }

            .leading-tight {
                line-height: 1.25;
            }

            .rounded-full {
                border-radius: 9999px;
            }

            .text-gray-700 {
                --text-opacity: 1;
                color: #374151;
                color: rgba(55, 65, 81, var(--text-opacity));
            }

            .border-gray-300 {
                --border-opacity: 1;
                border-color: #d2d6dc;
                border-color: rgba(210, 214, 220, var(--border-opacity));
            }

            .text-right {
                text-align: right;
            }

            .text-black {
                --text-opacity: 1;
                color: #000000;
                color: rgba(0, 0, 0, var(--text-opacity));
            }

            .text-xl {
                font-size: 1.25rem
                    /* 20px */
                ;
            }

            .font-bold {
                font-weight: 700;
            }

            .flex-grow {
                flex-grow: 1;
            }

            .bg-white {
                --bg-opacity: 1;
                background-color: #ffffff;
                background-color: rgba(255, 255, 255, var(--bg-opacity));
            }

            .rounded {
                border-radius: 0.25rem
                    /* 4px */
                ;
            }

            .px-8 {
                padding-left: 2rem
                    /* 32px */
                ;
                padding-right: 2rem
                    /* 32px */
                ;
            }

            .pt-1 {
                padding-top: 0.25rem
                    /* 4px */
                ;
            }

            .pt-1 {
                padding-top: 0.25rem
                    /* 4px */
                ;
            }

            .mb-4 {
                margin-bottom: 1rem
                    /* 16px */
                ;
            }

            .flex-col {
                flex-direction: column;
            }

            .inline-flex {
                display: inline-flex;
            }

            .items-center {
                align-items: center;
            }

            .justify-center {
                justify-content: center;
            }

            .px-4 {
                padding-left: 1rem
                    /* 16px */
                ;
                padding-right: 1rem
                    /* 16px */
                ;
            }

            .py-2 {
                padding-top: 0.5rem
                    /* 8px */
                ;
                padding-bottom: 0.5rem
                    /* 8px */
                ;
            }

            .border-transparent {
                border-color: transparent;
            }

            .rounded-md {
                border-radius: 0.375rem
                    /* 6px */
                ;
            }

            .font-semibold {
                font-weight: 600;
            }

            .text-white {
                --text-opacity: 1;
                color: #ffffff;
                color: rgba(255, 255, 255, var(--text-opacity));
            }

            .tracking-widest {
                letter-spacing: 0.1em;
            }

            .hover\:bg-gray-500:hover {
                --bg-opacity: 1;
                background-color: #6b7280;
                background-color: rgba(107, 114, 128, var(--bg-opacity));
            }

            .focus\:outline-none:focus {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }

            .focus\:border-gray-700:focus {
                --border-opacity: 1;
                border-color: #374151;
                border-color: rgba(55, 65, 81, var(--border-opacity));
            }

            .focus\:shadow-outline-red:focus {
                box-shadow: 0 0 0 3px rgba(248, 180, 180, 0.45);
            }

            .active\:bg-gray-600:active {
                --bg-opacity: 1;
                background-color: #4b5563;
                background-color: rgba(75, 85, 99, var(--bg-opacity));
            }

            .transition {
                transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            }

            .ease-in-out {
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }

            .duration-150 {
                transition-duration: 150ms;
            }

            button {
                border: none;
                background-color: transparent;
            }

            .bg-gray-200 {
                --bg-opacity: 1;
                background-color: #e5e7eb;
                background-color: rgba(229, 231, 235, var(--bg-opacity));
            }

            .border-gray-400 {
                --border-opacity: 1;
                border-color: #9fa6b2;
                border-color: rgba(159, 166, 178, var(--border-opacity));
            }

            .bg-yellow-400 {
                --bg-opacity: 1;
                background-color: #e3a008;
                background-color: rgba(227, 160, 8, var(--bg-opacity));
            }

            .bg-yellow-200 {
                --bg-opacity: 1;
                background-color: #fce96a;
                background-color: rgba(252, 233, 106, var(--bg-opacity));
            }

            /* .table_container {
            table-layout: fixed;
            overflow: auto;
        } */

            /* #tbl1 td,
        th {
            border: 1px solid !important;
        } */

            select {
                height: 25px;
                width: 100%;
            }

            .select2 {
                height: 35px !important;
                margin: 0px;
                width: 100%;
                padding: 0px;
                font-size: 12px !important;
            }

            .select2-selection__choice__remove {
                float: right;
                margin-right: 2px;
                font-size: 12px;
                margin-left: 2px;
            }

            .select2-selection__choice {
                height: 20px;
                background-color: #e7e7e7 !important;


                /* border-radius: 1px !important; */
            }

            .select2-results__option--highlighted {
                /* background-color: #E3A008 !important; */
                background-color: rgb(177, 175, 175) !important;
                color: #333 !important;

            }

            .select2-results__option {
                font-size: 12px;
                vertical-align: middle !important;
                padding-left: 8px !important;
            }

            table.autowidth td {
                white-space: nowrap;
            }

            .dropdown-grid {
                /* position: relative; */
                display: inline-block;
            }

            .dropdown-content-grid {
                display: none;
                position: absolute;
                /* right: 0; */
                background-color: #f1f1f1;
                min-width: 100px;
                /* overflow: auto; */
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 100;
                text-align: left;
            }

            .dropdown-content-grid a {
                color: black;
                padding: 1px 5px;
                text-decoration: none;
                display: block;
            }

            .dropdown-grid a:hover {
                background-color: #ddd;
            }

            .show-grid {
                display: block;
            }
        </style>
        {{-- <div wire:loading wire:target="gridExport">
            <div class="parent">
                <div class="child">
                    <img style="width: 40px; margin-top: 300px; margin-left: 35vw;"
                        src="{{ asset('images/loading.gif') }}" alt="">
                </div>
            </div>
        </div> --}}
        @if($chetak_grid_name)
        <input type="hidden" id="grid_id" value="{{$chetak_grid_name}}tbl1">
        <div wire:loading.remove wire:target="gridExport">
            <div class="table_container" style="min-height: 10vh;">
                @if(isset($groupable) && $groupable)
                <div ondrop="dropGridGroup()" ondragover="allowDropGrid(event)"
                    style="height: 30px; background-color:#f5f5f5 ">
                    @if(isset($per_page_item_show) && $per_page_item_show)
                    <input class="text-black px-2 border border-1 m-0.5 text-center" style="width:50px" type="text"
                        wire:model="per_page">
                    @endif
                    @foreach ($group_by as $key=>$gb)
                    <button style="padding: 2px; background-color: #9fa6b2"
                        wire:click="removeFromGroup({{$key}})">{{$gb}}X
                    </button>
                    @endforeach
                </div>
                @endif
                <div style="max-width: 94vw; max-height: 86vh; overflow: auto; min-height: 10vh; ">
                    <table id="{{$chetak_grid_name}}tbl1" style="width: 100%;">
                        <tr
                            class="bg-gray-400 text-xs font-semibold  text-left uppercase border border-gray-400 rounded">
                            @if($show_checkbox)
                            <td class="px-2 border">
                                <input type="checkbox" wire:model="select_all" id="">
                            </td>
                            @elseif($dragable)
                            <td></td>
                            @endif
                            @foreach ($headings as $heading)
                            <th class=" bg-gray-400 border filter px-2 cursor-move" draggable="true"
                                ondragover="allowDropGrid(event)" ondrop="dropGrid({{$heading['id']}})"
                                ondragstart="dragGrid({{$heading['id']}})" id="{{$heading['id']}}" nowrap
                                style="height: 28px; ">
                                <div class="flex cursor-move">
                                    <button class="text-sm bg-gray-400 cursor-move font-bold text-gray-800"
                                        wire:click="sort('{{$heading['field']}}')">
                                        {{strtoupper($heading['label'])}}
                                    </button>
                                    @if($heading['field']==$sortBy)
                                    @if($orderBy=="desc")
                                    <i class="fas fa-sort-amount-up-alt"></i>
                                    @elseif($orderBy=="asc")
                                    <i class="fas fa-sort-amount-down-alt"></i>
                                    @endif
                                    @endif
                                    @if($heading['filter']==true)
                                    @php
                                    $show_filter=null;
                                    if(isset($search_fields[$heading['field']]) && $search_fields[$heading['field']])
                                    {

                                    }
                                    else {
                                    $show_filter='show-filter';
                                    }
                                    @endphp
                                    <div class="mr-3" style="position: relative;">
                                        <div style="position: absolute;">
                                            <div class="dropbtn dropdown-grid">
                                                <button wire:click="showMenu({{$heading['id']}})"
                                                    class="dropbtn {{$show_filter}} fas fa-filter fa-md" title="Menu">
                                                </button>
                                                <div id="myDropdown-grid"
                                                    class="dropbtn dropdown-content-grid @if($heading['id']==$conTap)show-grid @endif bg-red-600"
                                                    style="margin-left: 0px; margin-top: 0px; width: 150px;">
                                                    <table class="text-gray-800">
                                                        @if($heading['field_type']=='number')
                                                        <tr>
                                                            <td>
                                                                <select wire:model="symbol_fields.{{$heading['field']}}"
                                                                    class="dropbtn border border-1 px-0.5 w-full">
                                                                    <option value="=">Equal to</option>
                                                                    <option value="!=">Not Equal to</option>
                                                                    <option value=">=">Gt Equal to</option>
                                                                    <option value="<=">Lt Equal to</option>
                                                                    <option value="<">Less then</option>
                                                                    <option value=">">Grater then</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        @if( $heading['field_type']=='date')
                                                        <tr>
                                                            <td>
                                                                <select wire:model="symbol_fields.{{$heading['field']}}"
                                                                    class="dropbtn border border-1 px-0.5 w-full">
                                                                    <option value="=">Equal to</option>
                                                                    <option value="!=">Not Equal to</option>
                                                                    <option value=">=">Gt Equal to</option>
                                                                    <option value="<=">Lt Equal to</option>
                                                                    <option value="<">Less then</option>
                                                                    <option value=">">Grater then</option>
                                                                    <option value="range">In Range</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if($heading['field_type']=="checkbox")
                                                        @if(isset($heading['relation']))
                                                        @foreach ($check_filter[$heading['field']] as $key=>$item_check)
                                                        @php
                                                        $mycol =$heading['field'];
                                                        $mycol1 =$heading['relation']['display_col'];
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <label>
                                                                    <input type="checkbox" class="dropbtn"
                                                                        wire:model="search_fields.{{$heading['field']}}.{{$item_check[$mycol] ?? 'blank'}}">
                                                                    {{$item_check[$mycol1] ?? 'Blank'}}
                                                                </label>

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                        @else
                                                        <tr>
                                                            <td>
                                                                <input type="{{$heading['field_type']}}"
                                                                    class="dropbtn border border-1 px-0.5"
                                                                    wire:model="search_fields.{{$heading['field']}}">

                                                            </td>
                                                        </tr>
                                                        @if ($symbol_fields[$heading['field']]=='range' &&
                                                        $heading['field_type']=="date")
                                                        <tr>
                                                            <td>
                                                                <input type="{{$heading['field_type']}}"
                                                                    class="dropbtn border border-1 px-0.5"
                                                                    wire:model="search_fields2.{{$heading['field']}}">
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @endif
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </th>
                            @endforeach
                            <th class="border" style="width:180px;">
                                <div style="float: right">
                                    <div class="flex" style="justify-content: space-between;width:180px;">
                                        <div class="">
                                            <div {{-- style="position: absolute;" --}}>
                                                <div class="dropdown-grid" style="">
                                                    <button wire:click="showMenu(99999)"
                                                        class="fa fa-bars fa-lg cursor-pointer " title="Menu">
                                                    </button>
                                                    <div id="myDropdown-grid"
                                                        class="dropdown-content-grid @if(99999==$conTap)show-grid @endif"
                                                        style="text-align: left;">
                                                        <table class="text-gray-800">
                                                            @foreach ($headings_filter as $item)
                                                            <tr>
                                                                <td style="font-size: 12px;">
                                                                    <input type="checkbox" class="dropbtn"
                                                                        wire:model="show_col.{{$item['id']}}">
                                                                    {{$item['label']}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="dropdown-grid">
                                                <button wire:click="showMenu(999999)" class="fas fa-search fa-lg"
                                                    title="Menu">
                                                </button>
                                                <div id="myDropdown-grid"
                                                    class="dropdown-content-grid @if(999999==$conTap)show-grid @endif"
                                                    style="text-align: left">
                                                    <input type="text" class="dropbtn border border-1 px-0.5"
                                                        wire:model="search_global">
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($exportable['excel']) && $exportable['excel']==true)
                                        <div>
                                            <button class="mx-1" wire:click="gridExport('xlsx')">
                                                <i class="fas fa-file-excel fa-lg"></i>
                                            </button>
                                        </div>
                                        @endif
                                        @if(isset($exportable['pdf']) && $exportable['pdf']==true)
                                        <div>
                                            <button class="mx-1" wire:click="gridExport('pdf')">
                                                <i class="fas fa-file-pdf fa-lg"></i>
                                            </button>
                                        </div>
                                        @endif
                                        @if($addable)
                                        <div>
                                            <button class="mx-1" wire:click="addNewClick">
                                                <i class="fas fa-plus-square fa-lg"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </th>
                        </tr>
                        {{-- <tbody> --}}
                            {{-- New row add start --}}
                            @if($add_new)
                            @php
                            $ctrr1=1;
                            @endphp
                            <tr style="border: 1px solid" class="bg-gray-300">
                                @if($show_checkbox || $dragable)
                                <td style="width:5px"></td>
                                @endif
                                @foreach ($headings as $heading)
                                @php
                                $column1 = $heading['field'];
                                @endphp
                                <td class="px-1 text-sm" style="white-space:nowrap;">
                                    @if(isset($heading['editable']) && $heading['editable']==false)
                                    N/A

                                    @php
                                    $ctrr1++;
                                    @endphp
                                    <br>
                                    <span class="text-red-700" style="color:red; text-transform: capitalize">
                                        @error('store_data.'.$column1){{$message}} @enderror
                                    </span>
                                    @else
                                    @if(isset($heading['relation']))
                                    @php
                                    $r_table=$heading['relation']['table_name'] ?? null;
                                    $r_table_id=$heading['relation']['relation_col'] ?? null;
                                    $r_where_con=$heading['relation']['where_con'] ?? null;
                                    $r_id=$heading['field'] ?? null;
                                    $r_display=$heading['relation']['display_col'] ?? null;
                                    @endphp
                                    @if(isset($heading['multiple']) && $heading['multiple']==true)
                                    @php
                                    $grid_dropdown =
                                    Illuminate\Support\Facades\DB::table($r_table)->pluck($r_display,$r_table_id) ;
                                    @endphp
                                    <div>
                                        <select wire:model="store_data.{{$column1}}"
                                            class="multi-select2 users_id border border-1 px-0.5"
                                            style="max-width: 200px" id="{{$r_id}}" multiple>
                                            <option value="">select</option>
                                            @foreach ($grid_dropdown as $key=>$item)
                                            <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span class="text-red-700" style="color:red; text-transform: capitalize">
                                            @error('store_data.'.$column1){{$message}} @enderror
                                        </span>
                                        <script>
                                            $(document).ready(function() {
                                                $('.multi-select2').select2();            
                                            document.addEventListener("updateSelect2", () => {
                                                $('.multi-select2').select2();
                                            });
                                            $('.users_id').on('change', function() {
                                                console.log('on change');
                                                let data = $(this).val();
                                                let col = $(this).attr('id');                                            
                                                window.Livewire.emit('userChange', data,col)
                                            })
                                        });
                                        </script>
                                    </div>
                                    @else
                                    {{-- @if(isset($heading['validation']['required'])) --}}
                                    @livewire('component.search-component-grid',
                                    [
                                    'table_name'=> $r_table,
                                    'search_column_name'=> $r_display,
                                    'table_id'=> $r_table_id,
                                    'name' => $r_id,
                                    'no_of_record' => 30,
                                    'where_con' => $r_where_con,
                                    'default_value' => $store_data[$r_id] ?? null,
                                    ]
                                    ,key($heading['field'].now()))
                                    <span class="text-red-700" style="color:red; text-transform: capitalize">
                                        @error('store_data.'.$column1){{$message}} @enderror
                                    </span>
                                    {{-- @else
                                    @php
                                    $grid_dropdown_single =
                                    Illuminate\Support\Facades\DB::table($r_table)->pluck($r_display,$r_table_id);
                                    @endphp
                                    <select class="single-select2 form-control" style="max-width: 200px">
                                        @foreach ($grid_dropdown_single as $key=>$item)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                                $('.multi-select2').select2(); 
                                        document.addEventListener("updateSelect2", () => {
                                            console.log('test');
                                            $('.single-select2').select2({tags: true }); });
                                         });
                                    </script>
                                    <span class="text-red-700">
                                        @error('store_data.'.$column1){{$message}} @enderror
                                    </span>
                                    @endif --}}
                                    @endif
                                    @elseif(isset($heading['fixed_value']))
                                    <select wire:model="store_data.{{$column1}}" class="border border-1 px-0.5"
                                        style="max-width: 200px">
                                        <option value="">select</option>
                                        @foreach ($heading['fixed_value'] as $key=>$item)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <span class="text-red-700" style="color:red; text-transform: capitalize">
                                        @error('store_data.'.$column1){{$message}} @enderror
                                    </span>
                                    @else
                                    <div x-data x-init="$refs.answer.focus()">
                                        @if($heading['field_type']=='image')
                                        <input type="file" wire:model="store_data.{{$column1}}"
                                            class="border border-1 px-0.5" @if($ctrr1==1) @endif
                                            accept="image/png, image/gif, image/jpeg" style="max-width: 200px">
                                        <br>
                                        <span class="text-red-700" style="color:red; text-transform: capitalize">
                                            @error('store_data.'.$column1){{$message}} @enderror
                                        </span>

                                        @elseif($heading['field_type']=='number')
                                        <input autofocus style="max-width:80px" type="{{$heading['field_type']}}"
                                            wire:model="store_data.{{$column1}}" class="border border-1 px-0.5"
                                            @if($ctrr1==1) @endif>
                                        <br>
                                        <span class="text-red-700" style="color:red; text-transform: capitalize">
                                            @error('store_data.'.$column1){{$message}} @enderror
                                        </span>
                                        @else
                                        <input x-ref="answer" autofocus style="max-width:200px"
                                            type="{{$heading['field_type']}}" wire:model="store_data.{{$column1}}"
                                            class="border border-1 px-0.5" @if($ctrr1==1) @endif>
                                        <br>
                                        <span class="text-red-700" style="color:red; text-transform: capitalize">
                                            @error('store_data.'.$column1){{$message}} @enderror
                                        </span>
                                        @endif
                                    </div>
                                    @php
                                    $ctrr1++;
                                    @endphp
                                    @endif
                                    @endif
                                </td>
                                @endforeach
                                <td class="px-2 text-sm" style="width:180px;">
                                    <div style="float: right">
                                        <div class="flex" style=" width:180px">
                                            <button wire:click="update"
                                                class="px-1 font-semibold leading-tight rounded-full">
                                                <i class="fas fa-save fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            <button wire:click.prevent="editModeOff"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-times fa-md" style="color: red"
                                                    aria-hidden=" true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            {{-- New row add end --}}
                            @if(count($group_by)>0)
                            @foreach ($recoders as $key=> $recoder)
                            <tr
                                style="background-color:  @if($loop->even) #FFFACD @else #FFFFE0; @endif border: 1px solid #000">

                                <td colspan="{{count($headings)+1}}">
                                    @if(in_array($key,$expand_item))
                                    <button wire:click="collaps('{{$key}}')" style="padding: 4px">-</button> {{$key}}
                                    ({{count($recoder)}})
                                    @else
                                    <button wire:click="expand('{{$key}}')" style="padding: 4px">></button> {{$key}}
                                    ({{count($recoder)}})
                                    @endif
                                </td>
                            </tr>
                            @if($isExpand && in_array($key,$expand_item))
                            @foreach ($recoder as $item)
                            <tr @if(!$is_edit) wire:click="rowSelected({{$item->$pk}},{{$loop->iteration}})" @endif
                                id="{{$loop->iteration}}_{{$item->$pk}}"
                                class="text-gray-700 border-b border-gray-300 tr-hover @if($loop->even) @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-200 @endif  @else @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-100 @endif  @endif  ">
                                @php
                                $ctrr=1;
                                @endphp
                                @foreach ($headings as $key=>$heading)
                                <td class="px-1 text-sm @if($heading['field_type']=='number' ) text-right
                                    @endif" nowrap style="padding-right: 20px;">

                                    @php
                                    $value=null;
                                    $column = $heading['field'];
                                    if(isset($heading['relation']))
                                    {
                                    $r_col=$heading['relation']['display_col'];
                                    $value=$item->$column;
                                    }
                                    elseif($heading['field_type']=='number')
                                    {
                                    if(isset($heading['number_format'][0]) && $heading['number_format'][0])
                                    {
                                    if(isset($item->$column))
                                    {
                                    $value = number_format($item->$column ?? 0,$heading['number_format'][1]);
                                    }

                                    }else{

                                    $value = number_format($item->$column,0);
                                    }
                                    }
                                    elseif($heading['field_type']=='date')
                                    {
                                    if($item->$column )
                                    {

                                    $value = Carbon\Carbon::parse($item->$column)->format('d-m-Y');
                                    }
                                    else{
                                    $value="";
                                    }
                                    }
                                    elseif($heading['field_type']=='bit')
                                    {
                                    if(isset($item->$column))
                                    {
                                    $value = $heading['fixed_value'][$item->$column];
                                    }
                                    else {
                                    $value = 'No';
                                    }
                                    }
                                    else {
                                    $value = $item->$column;
                                    }
                                    @endphp
                                    @if(!$add_new && $is_edit && $pk_value==$item->$pk && $pk!=$column && isset($heading['editable'])
                                    && $heading['editable']==true)
                                    @if(isset($heading['relation']))
                                    @php
                                    $r_table=$heading['relation']['table_name'];
                                    $r_table_id=$heading['relation']['relation_col'];
                                    $r_id=$heading['field'];
                                    $r_display=$heading['relation']['display_col'];
                                    $r_where_con=$heading['relation']['where_con'] ?? null;
                                    $where_col=$heading['relation']['where_col'] ?? null;
                                    $where_value_col=$heading['relation']['where_value_col'] ?? null;
                                    @endphp
                                    @if(isset($heading['multiple']) && $heading['multiple']==true)
                                    @php
                                    $grid_dropdown =
                                    Illuminate\Support\Facades\DB::table($r_table)->pluck($r_display,$r_table_id) ;
                                    @endphp
                                    <div>
                                        <select wire:model="store_data.{{$column1}}"
                                            class="multi-select2 users_id border border-1 px-0.5" style="width: 200px"
                                            id="{{$r_id}}" multiple>
                                            <option value="">select</option>
                                            @foreach ($grid_dropdown as $key=>$item)
                                            <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            $(document).ready(function() {
                                                $('.multi-select2').select2();            
                                            document.addEventListener("updateSelect2", () => {
                                                $('.multi-select2').select2();
                                            });
                                            $('.users_id').on('change', function() {
                                                console.log('on change');
                                                let data = $(this).val();
                                                let col = $(this).attr('id');                                            
                                                window.Livewire.emit('userChange', data,col)
                                            })
                                        });
                                        </script>
                                    </div>
                                    @else
                                    @livewire('component.search-component-grid',
                                    [
                                    'table_name'=> $r_table,
                                    'search_column_name'=> $r_display,
                                    'table_id'=> $r_table_id,
                                    'name' => $r_id,
                                    'no_of_record' => 30,
                                    'default_value' => $store_data[$r_id],
                                    'where_column' => $where_col ,
                                    'where_value' => $store_data[$where_value_col] ?? null,
                                    'where_con' => $r_where_con
                                    ]
                                    ,key($heading['field'].now()))
                                    @endif
                                    @elseif(isset($heading['fixed_value']))
                                    <select wire:model="store_data.{{$column1}}" class="border border-1 px-0.5"
                                        style="width: 200px">
                                        <option value="">select</option>
                                        @foreach ($heading['fixed_value'] as $key=>$item)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <div>
                                        @if($heading['field_type']=='image')
                                        <input type="file" wire:model="store_data.{{$column}}"
                                            class="border border-1 px-0.5" @if($ctrr==1) @endif
                                            accept="image/png, image/gif, image/jpeg">
                                        @else
                                        <input type="{{$heading['field_type']}}" wire:model="store_data.{{$column}}"
                                            class="border border-1 px-0.5" @if($ctrr==1) @endif>
                                        @endif
                                    </div>
                                    @php
                                    $ctrr++;
                                    @endphp
                                    @endif
                                    @else
                                    {{$value}}
                                    @endif
                                </td>
                                @endforeach
                                <td style="width:180px;">
                                    <div style="float: right">
                                        <div class="flex text-sm" style="justify-content: space-between; width:180px">
                                            @if($is_edit && $pk_value==$item->$pk)
                                            <button wire:click.prevent="update"
                                                class="px-1 font-semibold leading-tight rounded-full">
                                                <i class="fas fa-save fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            <button wire:click.prevent="editModeOff"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-times fa-md" style="color: red"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @else
                                            @if($inline_edit)
                                            <button wire:click.prevent="getPk({{$item->$pk }},'inlineEdit')"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-edit fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @else
                                            @if($editable)
                                            <button wire:click.prevent="getPk({{$item->$pk }},'edit')"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-edit fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @endif
                                            @endif
                                            @if($viewable)
                                            <button wire:click.prevent="getPk({{$item->$pk }},'view')"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-eye fa-md" style="color: rgb(19, 109, 136) "
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @endif
                                            @if($deletable)
                                            <button wire:click.prevent="deleteModalShow({{$item->$pk }})"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fa fa-trash fa-md" style="color: #C70039"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach

                            @else
                            @forelse ($recoders as $item)
                            @if($dragable)
                            <tr oncontextmenu="return showContextMenu1(event,'{{$chetak_grid_name}}','{{$item->$pk}}')"
                                ondragover="allowDropGrid(event)"
                                ondrop="dropGridRow('{{$chetak_grid_name}}',{{$item->$pk}})"
                                id="{{$loop->iteration}}_{{$item->$pk}}"
                                class="text-gray-700 border-b border-gray-300 tr-hover @if($loop->even) @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-200 @endif  @else @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-100 @endif  @endif  ">
                                @else
                            <tr oncontextmenu="return showContextMenu1(event,'{{$chetak_grid_name}}','{{$item->$pk}}')"
                                @if(!$is_edit) wire:click="rowSelected({{$item->$pk}},{{$loop->iteration}})" @endif
                                id="{{$loop->iteration}}_{{$item->$pk}}"
                                class="text-gray-700 border-b border-gray-300 tr-hover @if($loop->even) @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-200 @endif  @else @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-100 @endif  @endif  ">
                                @endif
                                @php
                                $ctrr=1;
                                @endphp
                                @if($show_checkbox && $dragable)
                                <td class="flex px-2 border">
                                    <i class="fas fa-arrows-alt text-md cursor-move pr-2"></i>
                                    <input type="checkbox" wire:model="selected_checkbox.{{$item->$pk}}" id="">
                                </td>
                                @elseif($dragable)
                                <td class="px-2 border" draggable="true" ondragstart="dragGrid({{$item->$pk}})">
                                    <i class="fas fa-arrows-alt text-md cursor-move"></i>
                                </td>
                                @elseif($show_checkbox)
                                <td class="px-2 border">
                                    <input type="checkbox" wire:model="selected_checkbox.{{$item->$pk}}" id="">
                                </td>
                                @endif
                                @foreach ($headings as $key=>$heading)
                                <td class="px-2 text-sm border  @if($heading['field_type']=='number' ) text-right
                                    @endif" nowrap @if($loop->iteration==1) width='10px' @endif @if(!$is_edit)
                                    wire:click="rowSelected({{$item->$pk}},{{$loop->parent->iteration}})" @endif>
                                    @php
                                    $value=0;
                                    $column = $heading['field'];
                                    if(isset($heading['relation']))
                                    {
                                    if(isset($heading['multiple']) && $heading['multiple'] ==true)
                                    {
                                    $multiple_string=null;
                                    $r_table=$heading['relation']['table_name'];
                                    $r_table_id=$heading['relation']['relation_col'];
                                    $r_display=$heading['relation']['display_col'];
                                    $value=$item->$column ;
                                    }
                                    else{
                                    $r_display=$heading['relation']['display_col'];
                                    if (isset($heading['relation']['display_col1'][0])) {
                                    $second_col = $heading['field'].$heading['relation']['display_col1'][0];
                                    $value=$item->$column." (".$item->$second_col.")";
                                    }
                                    else{
                                    $value=$item->$column;
                                    }
                                    }
                                    }
                                    elseif($heading['field_type']=='number')
                                    {
                                    if(isset($heading['number_format'][0]) && $heading['number_format'][0])
                                    {
                                    if(isset($item->$column))
                                    {
                                    $value = number_format($item->$column ?? 0,$heading['number_format'][1]);
                                    }
                                    else {
                                    $value = number_format($item->$column ?? 0,$heading['number_format'][1]);
                                    }

                                    }else{
                                    $value = number_format($item->$column,0);
                                    }
                                    }elseif($heading['field_type']=='date')
                                    {
                                    if($item->$column )
                                    {
                                    $value = trim(Carbon\Carbon::parse($item->$column)->format('d-m-Y'));
                                    }
                                    else{
                                    $value="";
                                    }
                                    }
                                    elseif($heading['field_type']=='time')
                                    {
                                    if($item->$column )
                                    {

                                    $value = Carbon\Carbon::parse($item->$column)->format('G:i A');
                                    }
                                    else{
                                    $value="";
                                    }
                                    }
                                    elseif($heading['field_type']=='bit')
                                    {
                                    if(isset($item->$column))
                                    {
                                    $value = $heading['fixed_value'][$item->$column];
                                    }
                                    else {
                                    $value = 'No';
                                    }
                                    }

                                    elseif($heading['field_type']=='image') {
                                    if(isset($item->$column))
                                    {
                                    $path = asset('/public/storage/'.$item->$column);
                                    $value = "<img style='width:50px; cursor: pointer;' wire:click="."
                                        showImage('".$path."')"." src='".$path."'>";

                                    // $value = $path."/".$item->$column;
                                    }

                                    }
                                    else {
                                    $value = $item->$column;
                                    }
                                    @endphp
                                    @if($is_edit && $pk_value==$item->$pk && $pk!=$column && isset($heading['editable'])
                                    && $heading['editable']==true)
                                    @if(isset($heading['relation']))
                                    @php
                                    $r_table=$heading['relation']['table_name'] ?? null;
                                    $r_table_id=$heading['relation']['relation_col'] ?? null;
                                    $r_id=$heading['field'] ?? null;
                                    $r_display=$heading['relation']['display_col'] ?? null;
                                    $r_where_con=$heading['relation']['where_con'] ?? null;
                                    $where_col=$heading['relation']['where_col'] ?? null;
                                    $where_value_col=$heading['relation']['where_value_col'] ?? null;
                                    @endphp
                                    @if(isset($heading['multiple']) && $heading['multiple']==true)
                                    @php

                                    $grid_dropdown =
                                    Illuminate\Support\Facades\DB::table($r_table)->pluck($r_display,$r_table_id);
                                    @endphp
                                    <div>
                                        <select wire:model="store_data.{{$r_id}}"
                                            class="multi-select2 users_id border border-1 px-0.5"
                                            style="min-width: 200px" id="{{$r_id}}" multiple>
                                            <option value="">select</option>
                                            @foreach ($grid_dropdown as $key2=>$item2)
                                            <option value="{{$key2}}">{{$item2}}</option>
                                            @endforeach
                                        </select>

                                        <script>
                                            $(document).ready(function() {
                                                $('.multi-select2').select2();            
                                            document.addEventListener("updateSelect2", () => {
                                                $('.multi-select2').select2();
                                            });
                                            $('.users_id').on('change', function() {
                                                let data = $(this).val();
                                                let col = $(this).attr('id');                                            
                                                window.Livewire.emit('userChange', data,col)
                                            })
                                        });
                                        </script>
                                    </div>
                                    @else
                                    @livewire('component.search-component-grid',
                                    [
                                    'table_name'=> $r_table,
                                    'search_column_name'=> $r_display,
                                    'table_id'=> $r_table_id,
                                    'name' => $r_id,
                                    'no_of_record' => 30,
                                    'default_value' => $store_data[$r_id],
                                    'where_column' => $where_col ,
                                    'where_value' => $store_data[$where_value_col] ?? null,
                                    'where_con' => $r_where_con,

                                    ]
                                    ,key($heading['field'].now()))
                                    @endif
                                    @elseif(isset($heading['fixed_value']))
                                    <select wire:model="store_data.{{$column}}" class="border border-1 px-0.5"
                                        style="max-width: 200px">
                                        <option value="">select</option>
                                        @foreach ($heading['fixed_value'] as $key1=>$item1)
                                        <option value="{{$key1}}">{{$item1}}</option>
                                        @endforeach
                                    </select>

                                    @else
                                    <div>
                                        @if($heading['field_type']=='image')
                                        <input type="file" wire:model="store_data.{{$column}}"
                                            class="border border-1 px-0.5" @if($ctrr==1) @endif
                                            accept="image/png, image/gif, image/jpeg">

                                        @else
                                        <input type="{{$heading['field_type']}}" wire:model="store_data.{{$column}}"
                                            class="border border-1 px-0.5" @if($ctrr==1) @endif>

                                        @endif
                                    </div>

                                    @php
                                    $ctrr++;
                                    @endphp
                                    @endif
                                    @else
                                    @php
                                    echo trim($value);
                                    @endphp
                                    @endif
                                </td>
                                @endforeach
                                <td class="border" style="width:180px">
                                    <div style="float: right">
                                        <div class="flex text-sm" style="justify-content: space-between; width:180px">
                                            @if($is_edit && $pk_value==$item->$pk)
                                            <button wire:click.prevent="update"
                                                class="px-1 font-semibold leading-tight rounded-full">
                                                <i class="fas fa-save fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            <button wire:click.prevent="editModeOff"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-times fa-md" style="color: red"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @else
                                            @if($inline_edit)
                                            <button wire:click.prevent="getPk({{$item->$pk }},'inlineEdit')"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-edit fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @else
                                            @if($editable)
                                            <button wire:click.prevent="getPk({{$item->$pk }},'edit')"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-edit fa-md" style="color: green"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @endif
                                            @endif
                                            @if($viewable)
                                            <button wire:click.prevent="getPk({{$item->$pk }},'view')"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fas fa-eye fa-md" style="color: rgb(19, 109, 136) "
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @endif
                                            @if($deletable)
                                            <button wire:click.prevent="deleteModalShow({{$item->$pk }})"
                                                class="px-1   font-semibold leading-tight rounded-full">
                                                <i class="fa fa-trash fa-md" style="color: #C70039"
                                                    aria-hidden=" true"></i>
                                            </button>
                                            @endif

                                            @if(count($dropdown_menu)>0)
                                            <div>
                                                <div class="flex text-center " style="text-align: center;">
                                                    <div>
                                                        <style>
                                                            .dropdown-content-grid td {
                                                                text-align: left;
                                                            }
                                                        </style>
                                                        <div class="dropdown-grid">
                                                            <button wire:click="showMenu('menu{{$item->$pk}}')"
                                                                class="dropbtn fa fa-bars fa-md cursor-pointer "
                                                                title="Menu">
                                                            </button>
                                                            <div id="myDropdown-grid"
                                                                class="dropdown-content-grid @if('menu'.$item->$pk==$conTap)show-grid @endif"
                                                                style="right:23px; width:200px;">
                                                                <table class="text-gray-800">
                                                                    <tr>
                                                                        @foreach ($dropdown_menu as $d_menu)
                                                                        @if(isset($d_menu['is_anchor']) &&
                                                                        $d_menu['is_anchor'])
                                                                        <td>
                                                                            <a target="{{$d_menu['target'] ?? ""}}"
                                                                                href="{{asset($d_menu['action'].'/'.$item->$pk)}}"
                                                                                class="cursor-pointer">
                                                                                <i class="{{$d_menu['icon'] ?? ""}}"
                                                                                    aria-hidden="true"></i><span
                                                                                    class="text-sm pl-2">
                                                                                    {{$d_menu['text'] ?? 'NA'}}
                                                                                </span>
                                                                                </button>
                                                                        </td>
                                                                        @else
                                                                        <td>
                                                                            <button
                                                                                wire:click.prevent="getPk('{{$item->$pk}}', '{{$d_menu['action'] ?? 'NA'}}')"
                                                                                class="cursor-pointer">
                                                                                <i class="{{$d_menu['icon'] ?? ""}}"
                                                                                    aria-hidden="true"></i><span
                                                                                    class="text-sm pl-2">
                                                                                    {{$d_menu['action'] ?? 'NA'}}
                                                                                </span>
                                                                            </button>
                                                                        </td>
                                                                        @endif
                                                                        @if ($loop->even)
                                                                    </tr>
                                                                    <tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr oncontextmenu="return showContextMenu1(event,'{{$chetak_grid_name}}','0')"
                                ondragover="allowDropGrid(event)" ondrop="dropGridRow('{{$chetak_grid_name}}',1)">
                                <td style="text-align: center; height: 200px;" colspan="{{count($headings)}}">No Data
                                </td>
                            </tr>
                            @endforelse
                            @endif
                            {{--
                        </tbody> --}}
                        @if(count($this->total_sum)>0)
                        <tfoot>
                            <tr
                                class="bg-gray-400 border-y border-gray-600 text-xs font-semibold tracking-wide text-left uppercase border-b">
                                @foreach ($headings as $heading)
                                <td class="px-2 text-sm @if($loop->iteration>1) text-right @endif">
                                    @if($loop->iteration==1)
                                    Total
                                    @else
                                    @php
                                    $value=null;
                                    if(isset($this->total_sum[$heading['field']])){
                                    if(isset($heading['number_format'][0]) && $heading['number_format'][0])
                                    {
                                    $value =
                                    number_format($this->total_sum[$heading['field']],$heading['number_format'][1]);
                                    }else{
                                    $value = number_format($this->total_sum[$heading['field']],3);
                                    }
                                    }
                                    @endphp
                                    {{$value}}
                                    @endif
                                </td>
                                @endforeach
                                <td class="px-2 text-sm text-right" style="width:180px;">
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>

                </div>
                @if (!count($this->group_by) > 0)
                {{$recoders->links()}}
                @endif
            </div>
        </div>



        {{-- Right click feature --}}
        <div id="{{$chetak_grid_name}}contextMenu" class="context-menu" style="display: none">
            <ul id="context_ul">
                @if($exportable)
                @if(isset($exportable['excel']))
                <li>
                    <button class="" wire:click="gridExport('xlsx')">
                        <i class="fas fa-file-excel fa-lg text-green-600"></i> Excel Export
                    </button>
                </li>
                @endif
                @if(isset($exportable['pdf']))
                <li>
                    <button class="" wire:click="gridExport('pdf')">
                        <i class="fas fa-file-pdf fa-lg text-red-600"></i> PDF Export
                    </button>
                </li>
                @endif
                @endif
                <hr>
                @if($inline_edit)
                <li>
                    <button class="my_btn" id="inlineEdit">
                        <i class="fas fa-edit fa-lg" style="color: green" aria-hidden=" true"></i> Edit
                    </button>
                </li>
                @else
                @if($editable)
                <li>
                    <button class="my_btn" id="edit">
                        <i class="fas fa-edit fa-lg" style="color: green" aria-hidden=" true"></i> Edit
                    </button>
                </li>
                @endif
                @endif
                @if($viewable)
                <li>
                    <button class="my_btn" id="view">
                        <i class="fas fa-eye fa-lg" style="color: rgb(19, 109, 136) " aria-hidden=" true"></i> View
                    </button>
                </li>
                @endif
                @if($deletable)
                <li>
                    <button class="my_btn" id="delete">
                        <i class="fa fa-trash fa-lg" style="color: #C70039" aria-hidden=" true"></i> Delete
                    </button>
                </li>
                @endif
                <hr>
                @foreach ($context_menu as $item)
                @if(isset($item['is_anchor']) && $item['is_anchor'])
                <li>
                    <button class="my_btn"
                        id="{{$item['action']}}-{{$item['is_anchor'] ?? false}}-{{$item['target'] ?? ""
                }}">
                        <i class="{{$item['icon'] ?? 'fas fa-question-circle'}}"></i> {{$item['text'] ?? 'text'}}
                    </button>
                </li>
                @else
                <li>
                    <button class="my_btn" id="{{$item['action'] ?? 'action'}}">
                        <i class="{{$item['icon'] ?? 'fas fa-question-circle'}}"></i> {{$item['text'] ?? 'text'}}
                    </button>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        {{-- <x-jet-confirmation-modal wire:model="deleteModal" maxWidth="md">
            <x-slot name="title">
                <div class="flex">
                    <div class="bg-white px-2 text-black w-full text-xl font-bold">
                        Delete Confirmation
                    </div>
                </div>

                <hr>
            </x-slot>

            <x-slot name="content">
                <div class="flex-grow">
                    <div class="bg-gray-100  w-full ">
                        <div class="bg-white  rounded px-8 pt-1 pb-8 mb-4 flex flex-col">
                            Are you sure want to delete?
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button wire:click="$toggle('deleteModal')" wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-red active:bg-gray-600 transition ease-in-out duration-150">
                    Cancel
                </button>
                <x-jet-danger-button wire:click="deleteRow({{$pk_value}})" wire:loading.attr="disabled">
                    Delete
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal> --}}
        {{-- <x-jet-dialog-modal wire:model="imageZoom" maxWidth="md">
            <x-slot name="title">
                <div class="flex">
                    <div class="bg-white px-2 text-black w-full text-xl font-bold">
                        Image
                    </div>
                    <div class="float-right p-2">
                        <x-jet-secondary-button wire:click="$toggle('imageZoom')" wire:loading.attr="disabled">
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
                                <img src="{{$image_zoom_path}}?{{now()}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('imageZoom')" wire:loading.attr="disabled">
                    Close
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal> --}}
        {{-- @push('scripts') --}}

        {{-- @endpush --}}
        <script>
            window.addEventListener('keydown', function(event) {
            
            if (event.key == "Escape") {
                    // @this.emitSelf('close')
                }
                if (event.altKey && event.key=='s') {
                    @this.emit('update')
                }
                if (event.altKey && event.key=='a') {
                    console.log(event.key)
                    @this.emit('addNew')
                }
                if (event.key=='F2') {
                    @this.emit('edit')
                }
                if (event.key=='ArrowDown') {
                    @this.emit('errowKeyPress','>','asc')
                }
                if (event.key=='ArrowUp') {
                    @this.emit('errowKeyPress','<', 'desc')
                }                 
            });

            
            var start_id=null;
            var end_id=null;
            function dropGrid(row_id) {
                console.log('dropGrid');
                end_id=row_id;
                if(start_id!=end_id)
                {
                    Livewire.emit('sortIndex', start_id, end_id);
                }
            }

            function dragGrid(ev) {
                start_id=ev;
            }
            function dropGridGroup()
            {
                console.log(start_id);
                Livewire.emit('get_group_cols', start_id);
            }

            function dragoverGrid() {
                var e = event;
                e.preventDefault();
                let children = Array.from(e.target.parentNode.parentNode.children);
                if (children.indexOf(e.target.parentNode) > children.indexOf(row)) {
                    e.target.parentNode.after(row);
                    row_index = children.indexOf(e.target.parentNode);
                } else {
                    e.target.parentNode.before(row);
                    row_index = children.indexOf(e.target.parentNode);
                }
                console.log('dragover')
            }

            function allowDropGrid(ev) {
                ev.preventDefault();
                console.log('allowDrag')
            }
            function dropGridRow(chetak_grid_name,end_id) {
                console.log(chetak_grid_name);
                Livewire.emit('getDragRowId', start_id,end_id,chetak_grid_name);     
                }
        window.addEventListener('DOMContentLoaded', function () {
  var myComponent = Livewire.find('first_grid');
  // Use myComponent here...
});
            
            document.onclick = hideMenu;      
            function hideMenu() {
                var elements = document.getElementsByClassName("contextMenu")
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.display = "none";
                }
                
            }
            // $("#tbl1 tr").bind("contextmenu",function(e) {
          
            // });

            $('.my_btn').on('click', function(){
                var str =$(this).attr('id');
                var items = str.split("-");
                if (1 in items) {
                    var windowName = items[2];
                   var url =items[0]+"/"+$(this).val();
                    window.open(url, windowName);
                }else{
                    @this.emit('editWithContextMenu',$(this).val(),$(this).attr('id'))
                }
                
            })
            

        function showContextMenu1(e,chetak_grid_name,row_id) {
            e.preventDefault();
            var t_id = row_id;            
            $('.my_btn').val(t_id)
            if (document.getElementById(chetak_grid_name+"contextMenu")
                        .style.display == "block")
                        document.getElementById(chetak_grid_name+"contextMenu")
                        .style.display = "none"
                else{
                    var menu = document.getElementById(chetak_grid_name+"contextMenu")  
                    menu.style.display = 'block';
                    menu.style.left = e.pageX-60 + "px";
                    menu.style.top = e.pageY-5 + "px";
                }
        }
        </script>
        @else
        <h3>Grid name not define Ex: chetak_grid_name="chetak_grid_1"</h3>
        @endif

    </div>
</div>