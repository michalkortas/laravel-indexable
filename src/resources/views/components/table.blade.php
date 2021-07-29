<form id="filters_form" action="{{url()->current()}}" method="GET">
    @csrf
    <input type="hidden" name="tableFiltersModel" value="{{$modelName}}">

    @if($model)

        <table class="table table-hover table-borderless table-sticky @if(!$fullscreen) mb-0 @endif">
            <thead class="thead-dark thead-sticky">
            <tr>
                @if($fullscreen)
                <th></th>
                @endif
                @foreach($indexable ?? [] as $path => $name)
                    @if(is_array($name))
                        <th colspan="{{count($name)}}">{{$path}}</th>
                    @else
                        <x-indexable-th-filters
                            :tableFilters="$tableFilters"
                            :requestFilters="$requestFilters"
                            :name="$name"
                            :path="$path"/>
                    @endif
                @endforeach
            </tr>
            </thead>
            @if($twoDimensionalHeader)
                <thead class="thead-dark thead-sticky">
                @if($fullscreen)
                <th></th>
                @endif
                @foreach($indexable ?? [] as $path => $name)
                    @if(is_array($name))
                        @foreach($name ?? [] as $subPath => $subName)
                            <x-indexable-th-filters
                                :tableFilters="$tableFilters"
                                :requestFilters="$requestFilters"
                                :name="$subName"
                                :path="$subPath"/>
                        @endforeach
                    @endif
                @endforeach
                </thead>
            @endif
            <tbody>
            @foreach($items ?? [] as $item)
                <tr>
                    @if($fullscreen)
                    <td class="td-actions">
                        <div class="btn-toolbar" role="toolbar" aria-label="Możliwe akcje">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Możliwe akcje">

                                @if(Route::has($resource .'.show'))
                                    <a href="{{route($resource .'.show', [$item])}}" class="btn btn-primary shadow-sm">
                                        <i class="far fa-eye"></i>
                                        Zobacz
                                    </a>
                                @endif

                                @if(Route::has($resource .'.edit'))
                                    <a href="{{route($resource .'.edit', [$item])}}" class="btn btn-info shadow-sm">
                                        <i class="fas fa-edit"></i>
                                        Edytuj
                                    </a>
                                @endif

                                @if(Route::has($resource .'.destroy'))
                                    <button type="button" data-id="{{$item->id}}" data-table="{{$resource}}" data-toggle="modal" data-target="#confirmDeleteModal" class="btn btn-danger shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                        Usuń
                                    </button>
                                @endif
                            </div>
                        </div>

                    </td>
                    @endif
                    @foreach($columns ?? [] as $path => $name)
                        <x-indexable-td
                            :columns="$columns"
                            :item="$item"
                            :path="$path"
                            :loop="$loop"
                            :resource="$resource"
                            :actionButtons="$actionButtons"/>
                    @endforeach


                </tr>
            @endforeach
            </tbody>
        </table>
</form>



<div class="px-4 py-3 @if(!$fullscreen) d-none @endif">
    @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator )
        {{ $items->appends(request()->query())->links() }}
    @endif
</div>

@component('components.confirmDeleteModal') @endcomponent
@else
    <div class="alert alert-info m-3"><strong>Nie znaleziono</strong> żadnych danych w tej bazie.</div>
@endif
