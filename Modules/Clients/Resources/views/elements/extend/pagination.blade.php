@if ($paginator->hasPages())
<div class="wrap-pagination">
    <nav aria-label="Page navigation example ">
      	<ul class="pagination pagination-nd justify-content-center">
			{{-- Previous Page Link --}}
			@if ($paginator->onFirstPage())
				{{-- <li class="disabled">
					<a><i class="fa fa-angle-double-left"></i></a>
				</li> --}}
			@else
				<li class="page-item">
					<a class="page-link" href="{{ $paginator->previousPageUrl() }}">
						<<
					</a>
				</li>
			@endif
			{{-- Pagination Elements --}}
			@foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item"><a class="page-link active">{{ $page }}</a></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="page-item disabled"><a class="page-link"><i class="fa fa-ellipsis-h"></i></a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

			{{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item" class="disabled">
                    <a><i class="fa fa-angle-double-right"></i></a>
                </li>
            @endif
		</ul>
	</nav>
</div>
@endif