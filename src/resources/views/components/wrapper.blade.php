<div class="d-sm-flex justify-content-between">

    <h1 class="h5 mb-0 text-gray-800">
        {{$title}} <small class="text-muted">{{$description}}</small>
    </h1>
    <div class="d-flex justify-content-end">
        <div>
            @if($create)
                <a href="{{route($resource.'.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj nowy element</a>
            @endif
            @if($tableFilters)
                <button type="submit" form="filters_form" class="d-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-filter fa-sm text-white-50"></i>
                    Filtruj dane
                </button>
                <a href="{{url()->current()}}" class="d-inline-block btn btn-sm btn-danger shadow-sm">
                    <i class="fas fa-times-circle fa-sm text-white-50"></i>
                    Wyczyść filtry
                </a>
            @endif
        </div>

        <div>
            <x-index.pagination :attributes="$attributes" />
        </div>
    </div>

</div>
<div class="card shadow mb-4 index-full-screen">
    <div class="card-body p-0">
        <div class="table-wait w-100 h-100 d-flex justify-content-center align-items-center">
            <div class="text-center">
                <div class="spinner-border text-primary mb-2 font-weight-bold"  style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p>Proszę czekać.<br>Trwa ładowanie danych...</p>
            </div>

        </div>
        <div class="table-data d-none">
            <x-indexable-table
                :model="$model"
                :modelName="$modelName"
                :resource="$resource"
                :items="$items"
                :tableFilters="$tableFilters"
                :indexable="$indexable"
                :actionButtons="$actionButtons"
                >

                @isset($actions)
                    <x-slot name="actions">
                        {{$actions}}
                    </x-slot>
                @endisset
            </x-indexable-table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function() {
            document.querySelector('.table-wait').classList.add('d-none');
            document.querySelector('.table-wait').classList.remove('d-flex');
            document.querySelector('.table-data').classList.remove('d-none');
        })();
    </script>
@endpush
