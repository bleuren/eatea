@extends('layouts.site')

@section('content')
    <section>
        <div class="container">
            <div class="section-inner">
                <!-- ======= Menu Section ======= -->
                <section id="menu" class="menu">
                    <div class="flex justify-center">
                        <ul id="menu-flters">
                            <li data-filter="*" class="filter-active">{{ __('全部') }}</li>
                            <li data-filter=".filter-winter">{{ __('冬季限定') }}</li>
                            <li data-filter=".filter-summer">{{ __('夏季限定') }}</li>
                            <li data-filter=".filter-new">{{ __('新上市') }}</li>
                        </ul>
                    </div>
                    <div class="menu-container">
                        @foreach ($products as $product)
                            <div class="menu-item w-full @if ($product->tags) @foreach (json_decode($product->tags) as $tag)
                                    filter-{{ $tag }} @endforeach @endif">
                                    <div class="menu-content">
                                        <a
                                            href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a><span>${{ $product->price }}</span>
                                    </div>
                                    <div class="menu-ingredients">
                                        {{ $product->body }}
                                    </div>
                            </div>

                        @endforeach
                    </div>
                </section><!-- End Menu Section -->
            </div>
        </div>
    </section>
    <script>
        window.addEventListener('load', function() {
            var elem = document.querySelector('.menu-container');
            if (elem) {
                var menuIsotope = new Isotope(elem, {
                    itemSelector: '.menu-item',
                    layoutMode: 'fitRows'
                });
                document.addEventListener('click', function(e) {
                    for (var target = e.target; target && target != this; target = target.parentNode) {
                        if (target.matches('#menu-flters li')) {
                            document.querySelectorAll("#menu-flters li").forEach(function(item) {
                                item.classList.remove('filter-active');
                            });
                            e.target.classList.add('filter-active');
                            menuIsotope.arrange({
                                filter: e.target.getAttribute('data-filter')
                            });
                        }
                    }
                }, false);
            }
        });
    </script>
@endsection
