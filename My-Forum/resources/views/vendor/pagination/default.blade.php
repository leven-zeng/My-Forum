@if ($paginator->hasPages())
    <div style="text-align: center">
        <div class="laypage-main">
        {{-- Previous Page Link --}}
        {{--@if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif
--}}
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{--<li class="active"><span>}</span></li>--}}
                            <span class="laypage-curr">{{ $page }}</span>
                    @else
                        {{--<li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                            <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())

                <a href="{{$paginator->url($paginator->lastPage())}}" class="laypage-last" title="尾页">尾页</a>
            <a href="{{ $paginator->nextPageUrl() }}" class="laypage-next">下一页</a>
        {{--@else
            <li class="disabled"><span>&raquo;</span></li>--}}
        @endif
            </div>
    </div>


    {{--<div style="text-align: center">
        <div class="laypage-main"><span class="laypage-curr">1</span><a href="/jie/page/2/">2</a><a href="/jie/page/3/">3</a><a href="/jie/page/4/">4</a><a href="/jie/page/5/">5</a><span>…</span><a href="/jie/page/148/" class="laypage-last" title="尾页">尾页</a><a href="/jie/page/2/" class="laypage-next">下一页</a></div>
    </div>--}}
@endif
