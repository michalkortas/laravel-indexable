@if(array_key_exists($path, $columns))
    @if(substr($path, 0, 1) === '@')
        <x-dynamic-component :component="'Index.Special.'.ltrim($path, '@')" :item="$item" />
    @else

        @php($currentStep = data_get($item, $path) ?? '---')

        <td @if($loop->first) scope="row" @endif @if(strlen($currentStep) > 35) title="{{$currentStep}}" @endif class="@if($loop->first) sticky-td @endif @if(strlen($currentStep) > 35) td-truncate @endif" @if(strlen($currentStep) <= 35) nowrap @endif>
            @if(($actionButtons ?? true) && $loop->first)
                @if(Route::has($resource .'.show'))
                    <a href="{{route($resource .'.show', [$item])}}">
                @elseif(Route::has($resource .'.edit'))
                    <a href="{{route($resource .'.edit', [$item])}}">
                @endif
            @endif
            @if(is_bool($currentStep))
                @if($currentStep)
                    <span class="badge badge-success px-2 py-2">
                        <i class="fas fa-check-circle mr-1"></i>
                        {{__('Tak')}}
                    </span>
                @else
                    <span class="badge badge-danger px-2 py-2">
                        <i class="fas fa-times-circle mr-1"></i>
                        {{__('Nie')}}
                    </span>
                @endif
            @else
                @if(array_key_exists($path, $typeFilters) && $typeFilters[$path] === 'date')
                    {{ \Carbon\Carbon::make($currentStep)?->format('Y-m-d') }}
                @else
                    {{ $currentStep }}
                @endif
            @endif

            @if(($actionButtons ?? true) && $loop->first)
                @if(Route::has($resource .'.show'))
                    </a>
                @elseif(Route::has($resource .'.edit'))
                    </a>
                @endif
            @endif
        </td>
    @endif
@endif
