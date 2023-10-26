<th wire:click="setSortBy('{{ $name }}')" class="col-md-{{ $width }}" style="cursor: pointer;">
                           
    {{ $displayName }}

    @if ($sortBy != $name)
        
        <span class="mdi mdi-unfold-more-horizontal"></span>
    
    @elseif ($sortDirection === 'asc')

        <span class="mdi mdi-chevron-down"></span>

    @else

        <span class="mdi mdi-chevron-up"></span>

    @endif
</th>