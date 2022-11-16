<div id="homeMarketCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($slides->where('type', 'slide') as $b)
            <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                <img src="{{ $b->image }}" class="d-block w-100" alt="{{ $b->alt }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $b->title }}</h5>
                    <p>{{ $b->link }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
