<div class="root bg-white">

    <style type="text/css">
        .dropdown-grid {
            /* visibility: hidden; */
            margin-left: 10%;
        }

        .dropdown-content-grid {
            z-index: 100;
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 20px;
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

        .table_container {
            /* width: 92vw !important; */
            table-layout: fixed;
            overflow: auto;
        }

        /* #tbl1 td,
        th {
            border: 1px solid !important;
        } */
    </style>
    <style>
        .mycolor:hover {
            background-color: #E2B866;
        }

        .mycolor {
            /* background-color: rgb(53, 50, 50); */
            background-color: #374151;
            width: 100px;
            color: #fff;

        }

        .heading {
            color: #836410;
        }

        .custome-grid th {
            font-weight: 100;

        }

        .custome-grid th,
        .custome-grid td {
            border: 1px solid gray;
        }

        /*Grid Menu dropdown Start */
        .dropbtn {
            /* background-color: #292b2e;
                  color: white;
                  padding: 20px;
                  font-size: 16px;
                  border: none;
                  cursor: pointer;
                  z-index: 2; */
        }

        .dropbtn:hover,
        .dropbtn:focus {
            color: #646f77;
        }

        .dropdown-grid {
            position: relative;
            display: inline-block;
        }

        .dropdown-content-grid {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f1f1f1;
            min-width: 100px;
            /* overflow: auto; */
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 100;
            padding: 10px;
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

        .error {
            color: red !importent;
        }

        /*Grid Menu dropdown End */
    </style>
    {{-- <div wire:loading wire:target="gridExport">
        <div class="parent">
            <div class="child">
                <img style="width: 40px; margin-top: 300px; margin-left: 35vw;" src="{{ asset('images/loading.gif') }}"
                    alt="">
            </div>
        </div>
    </div> --}}
    <div wire:loading.remove wire:target="gridExport">
        <div style="width background-color: red" class="table_container">
            <div ondrop="dropGridGroup()" ondragover="allowDropGrid(event)">
                <input class="text-black px-2" style="width:50px" type="text" wire:model="per_page">
                @foreach ($group_by as $key=>$gb)
                <button style="padding: 2px; background-color: #9fa6b2" wire:click="removeFromGroup({{$key}})">{{$gb}}X
                </button>
                @endforeach
            </div>
            <table id="tbl1">
                <tr class="bg-gray-400 text-xs font-semibold border border-gray-400">

                    @foreach ($headings as $heading)
                    <td class="filter " draggable="true" ondragover="allowDropGrid(event)"
                        ondrop="dropGrid({{$heading['id']}})" ondragstart="dragGrid({{$heading['id']}})"
                        id="{{$heading['id']}}" nowrap style="text-align: left">
                        <button class="text-sm" wire:click="sort('{{$heading['field']}}')">
                            {{ucwords($heading['label'])}}
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
                        <div class="dropbtn dropdown-grid" style="@if($loop->iteration==1) min-widtd:80px;  @endif ">
                            <button wire:click="showMenu({{$heading['id']}})"
                                class="dropbtn {{$show_filter}} fas fa-filter fa-md" title="Menu">

                            </button>
                            <div id="myDropdown-grid"
                                class="dropbtn dropdown-content-grid @if($heading['id']==$conTap)show-grid @endif"
                                style=" @if($loop->iteration==1) left:-100px;  @endif z-index:999">
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
                                    @if (isset($symbol_fields[$heading['field']])&&
                                    $symbol_fields[$heading['field']]=='range' &&
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
                        @endif
                        </th>
                        @endforeach
                    <th class="py-1 ">
                        <div class="flex">
                            <div>
                                <div class="dropdown-grid">
                                    <button wire:click="showMenu(99999)" class="fa fa-bars fa-lg cursor-pointer "
                                        title="Menu">
                                    </button>
                                    <div id="myDropdown-grid"
                                        class="dropdown-content-grid @if(99999==$conTap)show-grid @endif"
                                        style="text-align: left; width:200px; ">
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
                            <div class="mx-3">
                                <div class="dropdown-grid">
                                    <button wire:click="showMenu(999999)" class="fas fa-search fa-lg" title="Menu">
                                    </button>
                                    <div id="myDropdown-grid"
                                        class="dropdown-content-grid @if(999999==$conTap)show-grid @endif"
                                        style="text-align: left">
                                        <input type="text" class="dropbtn border border-1 px-0.5"
                                            wire:model="search_global">
                                    </div>
                                </div>
                            </div>
                            @if($exportable)
                            <div>
                                <button class="mx-1" wire:click="gridExport">
                                    <i class="fas fa-file-download fa-lg"></i>
                                </button>
                            </div>
                            @endif
                            @if($addable)
                            <div>
                                <button class="mx-1" wire:click="addNew">
                                    <i class="fas fa-plus-square fa-lg"></i>
                                </button>
                            </div>
                            @endif
                        </div>

                    </th>
                </tr>
                {{-- <tbody> --}}
                    @if($add_new)
                    @php
                    $ctrr1=1;
                    @endphp
                    <tr style="border: 1px solid">

                        @foreach ($headings as $heading)
                        @php
                        $column1 = $heading['field'];
                        @endphp
                        <td class="px-2 text-sm" style="white-space:nowrap;">
                            @if(isset($heading['editable']) && $heading['editable']==false)
                            N/A
                            @php
                            $ctrr1++;
                            @endphp
                            @else
                            @if(isset($heading['relation']))
                            @php
                            $r_table=$heading['relation']['table_name'];
                            $r_table_id=$heading['relation']['relation_col'];
                            $r_id=$heading['field'];
                            $r_display=$heading['relation']['display_col'];
                            @endphp
                            @livewire('component.search-component-grid',
                            [
                            'table_name'=> $r_table,
                            'search_column_name'=> $r_display,
                            'table_id'=> $r_table_id,
                            'name' => $r_id,
                            'no_of_record' => 30,
                            'default_value' => $store_data[$r_id] ?? null,
                            ]
                            ,key($heading['field'].now()))
                            @else
                            <div x-data x-init="$refs.answer.focus()">
                                <div class="input-group input-group-sm">
                                    <input type="{{$heading['field_type']}}" wire:model="store_data.{{$column1}}"
                                        class="form-control" @if($ctrr1==1) x-ref="answer" @endif>
                                </div>
                            </div>
                            @php
                            $ctrr1++;
                            @endphp
                            @endif
                            @endif
                        </td>

                        @endforeach
                        <td class="px-2 text-sm flex">
                            <button wire:click.prevent="update" class="px-1 font-semibold leading-tight rounded-full">
                                <i class="fas fa-save fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            <button wire:click.prevent="editModeOff"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-times fa-md" style="color: red" aria-hidden=" true"></i>
                            </button>
                        </td>
                    </tr>
                    @endif
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
                        <td class="px-2 text-sm @if($heading['field_type']=='number' ) text-right
                                @endif" nowrap>
                            @php
                            $column = $heading['field'];
                            if(isset($heading['relation']))
                            {
                            $r_col=$heading['relation']['display_col'];
                            // $value=$item->$r_col;
                            $value=$item->$column;
                            }
                            elseif($heading['field_type']=='number')
                            {
                            if(isset($heading['number_format'][0]) && $heading['number_format'][0])
                            {
                            if(isset($item->$column))
                            {
                            $value = number_format($item->$column,$heading['number_format'][1]);
                            }

                            }else{

                            $value = number_format($item->$column,0);
                            }
                            }elseif($heading['field_type']=='date')
                            {
                            if($item->$column )
                            {

                            $value = Carbon\Carbon::parse($item->$column)->format('d-m-Y');
                            }
                            else{
                            $value="";
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
                            $r_table=$heading['relation']['table_name'];
                            $r_table_id=$heading['relation']['relation_col'];
                            $r_id=$heading['field'];
                            $r_display=$heading['relation']['display_col'];
                            $where_col=$heading['relation']['where_col'] ?? null;
                            $where_value_col=$heading['relation']['where_value_col'] ?? null;
                            @endphp
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
                            ]
                            ,key($heading['field'].now()))
                            @else
                            <div x-data x-init="$refs.answer.focus()">
                                <div class="input-group input-group-sm">
                                    <input type="{{$heading['field_type']}}" wire:model="store_data.{{$column}}"
                                        class="form-control" @if($ctrr==1) x-ref="answer" @endif>
                                </div>
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
                        <td class="px-2 text-sm flex justify-around">
                            @if($is_edit && $pk_value==$item->$pk)
                            <button wire:click.prevent="update" class="px-1 font-semibold leading-tight rounded-full">
                                <i class="fas fa-save fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            <button wire:click.prevent="editModeOff"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-times fa-md" style="color: red" aria-hidden=" true"></i>
                            </button>
                            @else
                            @if($inline_edit)
                            <button wire:click.prevent="getPk({{$item->$pk }},'inlineEdit')"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-edit fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            @else
                            @if($editable)
                            <button wire:click.prevent="getPk({{$item->$pk }},'edit')"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-edit fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            @endif
                            @endif
                            @if($viewable)
                            <button wire:click.prevent="getPk({{$item->$pk }},'view')"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-eye fa-md" style="color: rgb(19, 109, 136) " aria-hidden=" true"></i>
                            </button>
                            @endif
                            @if($deletable)
                            <button wire:click.prevent="deleteModalShow({{$item->$pk }})"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fa fa-trash fa-md" style="color: #C70039" aria-hidden=" true"></i>
                            </button>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    @endforeach

                    @else
                    @foreach ($recoders as $item)
                    <tr @if(!$is_edit) wire:click="rowSelected({{$item->$pk}},{{$loop->iteration}})" @endif
                        id="{{$loop->iteration}}_{{$item->$pk}}"
                        class="text-gray-700 border-b border-gray-300 tr-hover @if($loop->even) @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-200 @endif  @else @if($loop->iteration==$row_iteration) tr-selected @else bg-gray-100 @endif  @endif  ">
                        @php
                        $ctrr=1;
                        @endphp
                        @foreach ($headings as $key=>$heading)
                        <td class="px-1 text-sm @if($heading['field_type']=='number' ) text-right
                                @endif" nowrap>
                            @php
                            $column = $heading['field'];
                            if(isset($heading['relation']))
                            {
                            $r_col=$heading['relation']['display_col'];
                            // $value=$item->$r_col;
                            $value=$item->$column;
                            }
                            elseif($heading['field_type']=='number')
                            {
                            if(isset($heading['number_format'][0]) && $heading['number_format'][0])
                            {
                            if(isset($item->$column))
                            {
                            $value = number_format($item->$column,$heading['number_format'][1]);
                            }

                            }else{

                            $value = number_format($item->$column,0);
                            }
                            }elseif($heading['field_type']=='date')
                            {
                            if($item->$column )
                            {

                            $value = Carbon\Carbon::parse($item->$column)->format('d-m-Y');
                            }
                            else{
                            $value="";
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
                            $r_table=$heading['relation']['table_name'];
                            $r_table_id=$heading['relation']['relation_col'];
                            $r_id=$heading['field'];
                            $r_display=$heading['relation']['display_col'];
                            $where_col=$heading['relation']['where_col'] ?? null;
                            $where_value_col=$heading['relation']['where_value_col'] ?? null;
                            @endphp
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
                            ]
                            ,key($heading['field'].now()))
                            @else
                            <div x-data x-init="$refs.answer.focus()">
                                <div class="input-group input-group-sm">
                                <input type="{{$heading['field_type']}}" wire:model="store_data.{{$column}}"
                                    class="form-control" @if($ctrr==1) x-ref="answer" @endif>
                            </div>
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
                        <td class="px-2 text-sm flex justify-around">
                            @if($is_edit && $pk_value==$item->$pk)
                            <button wire:click.prevent="update" class="px-1 font-semibold leading-tight rounded-full">
                                <i class="fas fa-save fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            <button wire:click.prevent="editModeOff"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-times fa-md" style="color: red" aria-hidden=" true"></i>
                            </button>
                            @else
                            @if($inline_edit)
                            <button wire:click.prevent="getPk({{$item->$pk }},'inlineEdit')"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-edit fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            @else
                            @if($editable)
                            <button wire:click.prevent="getPk({{$item->$pk }},'edit')"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-edit fa-md" style="color: green" aria-hidden=" true"></i>
                            </button>
                            @endif
                            @endif
                            @if($viewable)
                            <button wire:click.prevent="getPk({{$item->$pk }},'view')"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fas fa-eye fa-md" style="color: rgb(19, 109, 136) " aria-hidden=" true"></i>
                            </button>
                            @endif
                            @if($deletable)
                            <button wire:click.prevent="deleteModalShow({{$item->$pk }})"
                                class="px-1   font-semibold leading-tight rounded-full">
                                <i class="fa fa-trash fa-md" style="color: #C70039" aria-hidden=" true"></i>
                            </button>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
                        <td class="px-2 text-sm text-right">
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


    {{-- Right click feature --}}
    <div id="contextMenu" class="context-menu" style="display: none">
        <ul id="context_ul">
            @if($exportable)
            <li>
                <button class="mx-1" wire:click="gridExport">
                    <i class="fas fa-file-download fa-lg"></i> Export
                </button>
            </li>
            @endif
            <li>
                <button id="my_btn" class="mx-1">
                    <i class="fas fa-edit fa-lg text-green-700"></i> Edit
                </button>
            </li>
        </ul>
    </div>
    <input type="hidden" id="pk" value="{{$row_selected}}">
    <script>
        window.addEventListener('keydown', function(event) {
            var pk = document.getElementById('pk').value;
            console.log("hello"+pk)
            if (event.key == "Escape") {
                    @this.emit('close')
                }
                if (event.altKey && event.key=='s') {
                    @this.emit('update')
                }
                if (event.altKey && event.key=='a') {
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
                console.log(event.key);                
            });
            var start_id=null;
            var end_id=null;
            function dropGrid(row_id) {
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

            
            document.onclick = hideMenu;      
            function hideMenu() {
                document.getElementById("contextMenu")
                        .style.display = "none"
            }
            $("#tbl1 tr").bind("contextmenu",function(e) {
            e.preventDefault();
            var row_id = $(this).attr('id')
            row_id = row_id.split("_")
            $('#my_btn').val(row_id[1])
            if (document.getElementById("contextMenu")
                        .style.display == "block")
                    hideMenu();
                else{
                    var menu = document.getElementById("contextMenu")  
                    menu.style.display = 'block';
                    menu.style.left = e.pageX-60 + "px";
                    menu.style.top = e.pageY-5 + "px";
                }
            });

            $('#my_btn').on('click', function(){
                console.log('click')
                @this.emit('editWithContextMenu',$('#my_btn').val())
            })
    </script>


</div>