<div class="main-width">
    <div class="wrap-slide">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($data['slide'] as $k=>$row)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $k }}"
                        class="{{ !$k ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($data['slide'] as $k => $row)
                    <div class="carousel-item {{ !$k ? 'active' : '' }}">
                        <a href="{{ $row->url }}" title="{{ $row->title }}">
                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'slide') }}" title="{{ $row->title }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>