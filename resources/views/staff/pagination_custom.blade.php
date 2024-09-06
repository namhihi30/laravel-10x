@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link @if($paginator->previousPageUrl() == null) d-none @endif" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&lt;&lt;</span>
                </a>
            </li>

            @php
                $currentPage = $paginator->currentPage();

                $endPage = ceil($currentPage / 3) * 3;
                $startPage = $endPage -2;

                if ($endPage > $paginator->lastPage()) {
                    $endPage = $paginator->lastPage();
                }

            @endphp

            @foreach (range($startPage, $endPage) as $page)
                @if ($page == $currentPage)
                    <li class="page-item active">
                        <a class="page-link" href="#" onclick="return false;">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach


            <li class="page-item">
                <a class="page-link @if($paginator->nextPageUrl() == null) d-none @endif"" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&gt;&gt;</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
