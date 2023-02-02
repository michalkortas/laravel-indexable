<th>
    @if(($tableFilters) && substr($path, 0, 1) !== '@')
        <div class="dropdown table-filters">
            <button title="{{__($name)}}" class="btn btn-block btn-truncate btn-xs {{($requestFilters[$path] ?? false) ? 'btn-primary' : 'btn-secondary'}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if($requestFilters[$path] ?? false)
                        <i class="fas fa-filter fa-sm text-white-50"></i>
                    @endif
                    {{__($name) ?? ''}}
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow p-2 pb-3">
                    <span class="dropdown-item bg-white text-black py-0 px-2" >
                        @if($isRangeFilter)
                            <x-form-text
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label="{{$filterLabels['from']}}"
                                placeholder="{{$filterLabels['from']}}"
                                class="form-control-sm"
                                group-class="mb-2"
                                name="tableFilters[{{$path}}][from]"
                                value="{{$requestFilters[$path]['from'] ?? ''}}"
                            ></x-form-text>

                            <x-form-text
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label="{{$filterLabels['to']}}"
                                placeholder="{{$filterLabels['to']}}"
                                class="form-control-sm"
                                group-class="mb-3"
                                name="tableFilters[{{$path}}][to]"
                                value="{{$requestFilters[$path]['to'] ?? ''}}"
                            ></x-form-text>
                        @else
                            <x-form-text
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label="{{$filterLabels['strict']}}"
                                placeholder="{{$filterLabels['strict']}}"
                                class="form-control-sm"
                                group-class="mb-3"
                                name="tableFilters[{{$path}}]"
                                value="{{$requestFilters[$path] ?? ''}}"
                            ></x-form-text>
                        @endif

                        <button class="btn btn-sm btn-secondary btn-block" type="submit">
                            <i class="fas fa-filter fa-sm text-white-50"></i>
                            {{__('Zastosuj filtr')}}
                        </button>

                    </span>
                </div>
            </div>
        @else
            {{__($name)}}
        @endif
    </th>
