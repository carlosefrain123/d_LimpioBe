@extends('layouts.app')

@section('content')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ $product->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                <div class="row g-4">
                    <!-- Imagen del Producto -->
                    <div class="col-xl-6 wow fadeInUp">
                        <div class="product-left-box">
                            <div class="row g-sm-4 g-2">
                                <div class="col-12">
                                    <div class="product-main no-arrow">
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                     class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                     alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Producto -->
                    <div class="col-xl-6 wow fadeInUp">
                        <div class="right-box-contain">
                            <h2 class="name">{{ $product->name }}</h2>

                            <div class="price-rating">
                                <h3 class="theme-color price">
                                    ${{ number_format($product->price, 2) }}
                                    <del class="text-content">${{ number_format($product->price2, 2) }}</del>
                                </h3>

                                <!-- Calificación del Producto -->
                                <div class="product-rating custom-rate">
                                    <ul class="rating">
                                        @php
                                            $rating = round($product->reviews()->avg('rating'));
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li>
                                                <i data-feather="star" class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    <span class="review">{{ $product->reviews()->count() }} Reseñas</span>
                                </div>
                            </div>

                            <div class="product-contain">
                                <p class="w-100">{{ $product->description }}</p>
                            </div>

                            <!-- Selección de cantidad y botones de acción -->
                            <div class="note-box product-package">
                                <div class="cart_qty qty-box product-qty">
                                    <div class="input-group">
                                        <button type="button" class="qty-left-minus" onclick="updateQuantity({{ $product->id }}, 'minus')">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input class="form-control input-number qty-input" type="text" id="qty-{{ $product->id }}" value="1">
                                        <button type="button" class="qty-right-plus" onclick="updateQuantity({{ $product->id }}, 'plus')">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <button class="btn btn-md bg-dark cart-button text-white w-100"
                                        onclick="addToCart({{ $product->id }}, '{{ asset('storage/' . $product->image) }}', '{{ route('product.details', [$product->id, $product->slug]) }}', '{{ $product->price }}' , '{{ $product->name }}')">
                                    Agregar al Carrito
                                </button>
                            </div>

                            <div class="buy-box">
                                <a href="javascript:void(0)" onclick="addToWishlist({{ $product->id }}, '{{ asset('storage/' . $product->image) }}', '{{ route('product.details', [$product->id, $product->slug]) }}', '{{ $product->price }}' , '{{ $product->name }}')">
                                    <i data-feather="heart"></i>
                                    <span>Agregar a Wishlist</span>
                                </a>
                            </div>

                            <!-- Opciones de Pago -->
                            <div class="payment-option">
                                <div class="product-title">
                                    <h4>Pago 100% Seguro</h4>
                                </div>
                                <ul>
                                    <li><a href="#"><img src="../assets/images/product/payment/1.svg" class="blur-up lazyload" alt=""></a></li>
                                    <li><a href="#"><img src="../assets/images/product/payment/2.svg" class="blur-up lazyload" alt=""></a></li>
                                    <li><a href="#"><img src="../assets/images/product/payment/3.svg" class="blur-up lazyload" alt=""></a></li>
                                    <li><a href="#"><img src="../assets/images/product/payment/4.svg" class="blur-up lazyload" alt=""></a></li>
                                    <li><a href="#"><img src="../assets/images/product/payment/5.svg" class="blur-up lazyload" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
