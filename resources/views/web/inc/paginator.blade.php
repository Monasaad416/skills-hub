@if($paginator->hasPages())

<!-- pagination -->
    <div class="col-md-12">
        <div class="post-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="#" class="pagination-back pull-left btn disabled">{{__('web.back')}}</a>   <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <a href="{{$paginator->previousPageUrl()}}" class="pagination-back pull-left">{{__('web.back')}}</a>
            @endif



            {{-- Pagination Elements --}}


            <ul class="pages">

            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                             <li class="active">{{$page}}</li>
                        @else
                            <li><a href="{{$url}}">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            </ul>


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl()}}" class="pagination-next pull-right">{{__('web.next')}}</a>
            @else
            <a href="#" class="pagination-next pull-right btn disabled">{{__('web.next')}}</a>
            @endif

        </div>
    </div>
<!-- pagination -->
@endif
