@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <!-- home section start -->
    @include('partials.home')
    <!-- Home Section End -->

    <!-- Category Section Start -->
    @include('partials.category')
    <!-- Category Section End -->

    <!-- Value Section Start -->
    @include('partials.value')
    <!-- Value Section End -->

    <!-- Banner Section Start -->
    @include('partials.banner1')
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    @include('partials.banner2')
    <!-- Product Section End -->

    <!-- Banner Section Start -->
    <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain-3 section-b-space section-t-space hover-effect">
                        <img src="../assets/images/veg-3/banner/3.png" class="img-fluid bg-img" alt="">
                        <div class="banner-detail p-center text-dark position-relative text-center p-0">
                            <div>
                                <h4 class="ls-expanded text-uppercase theme-color">Try Our New</h4>
                                <h2 class="my-3">100% Organic Best Quality Best Price</h2>
                                <h4 class="text-content fw-300">Best Fastkart Food Quality</h4>
                                <button class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold"
                                    onclick="location.href = 'shop-left-sidebar.html';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Newsletter Section Start -->
    @include('partials.news')
    <!-- Newsletter Section End -->

@endsection
