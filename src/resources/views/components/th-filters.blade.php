<th>
    @if(($tableFilters) && substr($path, 0, 1) !== '@')
        <div class="dropdown table-filters">
            <button title="{{__($name)}}" class="btn btn-block btn-truncate btn-sm {{($requestFilters[$path] ?? false) ? 'btn-primary' : 'btn-secondary'}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$requestFilters[$path] ?? __($name) ?? ''}}

            </button>
            <div class="dropdown-menu dropdown-menu-right shadow">
                <span class="dropdown-item py-0 px-2" >
                    @if($isRangeFilter)
                        <x-form-text
                            type="{{$filterType}}"
                            placeholder="{{__('Od')}}"
                            class="form-control-sm"
                            name="tableFilters[{{$path}}][from]"
                            value="{{$requestFilters[$path]['from'] ?? ''}}"
                        ></x-form-text>

                        <x-form-text
                            type="{{$filterType}}"
                            placeholder="{{__('Do')}}"
                            class="form-control-sm"
                            name="tableFilters[{{$path}}][to]"
                            value="{{$requestFilters[$path]['to'] ?? ''}}"
                        ></x-form-text>
                    @else
                        <x-form-text
                            type="{{$filterType}}"
                            placeholder="{{__('Wpisz frazę...')}}"
                            class="form-control-sm"
                            name="tableFilters[{{$path}}]"
                            value="{{$requestFilters[$path] ?? ''}}"
                        ></x-form-text>
                    @endif

                </span>
            </div>
        </div>
    @else
        {{__($name)}}
    @endif
</th>
