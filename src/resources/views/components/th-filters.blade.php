<th>
    @if(($tableFilters) && substr($path, 0, 1) !== '@')
        <div class="dropdown table-filters">
            <button title="{{__($name)}}" class="btn btn-block btn-truncate btn-xs {{!$isEmpty() ? 'btn-primary' : 'btn-secondary'}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(!$isEmpty())
                        <i class="fas fa-filter fa-sm text-white-50"></i>
                    @endif
                    {{__($name) ?? ''}}
                </button>
                <div class="filter-dropdown dropdown-menu dropdown-menu-right shadow-lg p-2 pb-3 z-index-3" style="border-width: 2px;">
                    <span class="dropdown-item bg-white text-dark py-0 px-2" style="width: 220px" >
                        @if($isRangeFilter)
                            <x-form-text
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label="{{$filterLabels['from']}}"
                                label-class="text-dark text-xs"
                                placeholder="{{$filterLabels['from']}}"
                                class="form-control-sm"
                                group-class="mb-2"
                                name="tableFilters[{{$path}}][from]"
                                value="{{$requestFilters[$path]['from'] ?? ''}}"
                            ></x-form-text>

                            <x-form-text
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label-class="text-dark text-xs"
                                label="{{$filterLabels['to']}}"
                                placeholder="{{$filterLabels['to']}}"
                                class="form-control-sm"
                                group-class="mb-3"
                                name="tableFilters[{{$path}}][to]"
                                value="{{$requestFilters[$path]['to'] ?? ''}}"
                            ></x-form-text>
                        @elseif($isBooleanFilter)
                            <x-form-select
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label-class="text-dark text-xs"
                                label="{{$filterLabels['strict']}}"
                                placeholder="{{$filterLabels['strict']}}"
                                class="form-control-sm"
                                group-class="mb-3"
                                name="tableFilters[{{$path}}]"
                                value="{{($requestFilters[$path] ?? '')}}"
                                :options="$booleanOptions"
                            ></x-form-select>
                        @else
                            <x-form-text
                                label-class="small italic mb-1"
                                type="{{$filterType}}"
                                label-class="text-dark text-xs"
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
