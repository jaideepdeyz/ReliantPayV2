@if ($paginator->hasPages())

<style>
    .lwpagination {
        display: inline-block;
    }

    .lwpagination li {
        list-style-type: none;
        display: inline;
    }

    .lwpagination .page-button {
        color: rgb(34, 80, 153);
        float: left;
        padding: 4px 12px;
        text-decoration: none;
        margin-left: 2px;
        border: 1px solid #888;
        border-radius: 3px;
        background-color:white;
        cursor: pointer;
    }

    .lwpagination .page-button.lwactive {
        color: white;
        background-color: #2196f3;
    }

    .lwpagination .lwdisabled {
        color: #ccc;
        border: 1px solid #ccc;
    }
</style>

<nav aria-label="Page navigation">
            <ul class="lwpagination">
                <li>
                    @if ($paginator->onFirstPage())
                    <button class="page-button lwdisabled" aria-label="Previous" id="prev-disabled">
                        <span aria-hidden="true">&laquo;Prev</span>
                    </button>
                    @else
                    <button class="page-button" aria-label="Previous" wire:click="previousPage" id="prev">
                        <span aria-hidden="true">&laquo;Prev</span>
                    </button>
                    @endif
                </li>

                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <li class="" aria-disabled="true"><span class="page-button lwdisabled">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li id="page-{{ $page }}-current" class="" aria-current="page"><span
                        class="page-button lwactive">{{ $page }}</span></li>
                @else
                <li id="page-{{ $page }}" class=""><span class="page-button"
                        wire:click="gotoPage({{ $page }})">{{ $page }}</span></li>
                @endif
                @endforeach
                @endif

                @endforeach

                <li>
                    @if ($paginator->hasMorePages())
                    <button class="page-button" aria-label="Next" wire:click="nextPage">
                        <span aria-hidden="true">Next &raquo;</span>
                    </button>
                    @else
                    <button class="page-button lwdisabled" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </button>
                    @endif
                </li>
            </ul>
        </nav>

@endif
