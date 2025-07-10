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
                                            <button type="button" class="qty-left-minus"
                                                onclick="updateQuantity({{ $product->id }}, 'minus')">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text"
                                                id="qty-{{ $product->id }}" value="1">
                                            <button type="button" class="qty-right-plus"
                                                onclick="updateQuantity({{ $product->id }}, 'plus')">
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
                                    <a href="javascript:void(0)"
                                        onclick="addToWishlist({{ $product->id }}, '{{ asset('storage/' . $product->image) }}', '{{ route('product.details', [$product->id, $product->slug]) }}', '{{ $product->price }}' , '{{ $product->name }}')">
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
                                        <li><a href="#"><img src="../assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="#"><img src="../assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="#"><img src="../assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="#"><img src="../assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="#"><img src="../assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de la Marca -->
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-name">
                                    <h5 class="fw-500">{{ $product->brand->name }}</h5>
                                </div>
                            </div>

                            <p class="vendor-detail">Explora productos de alta calidad de {{ $product->brand->name }}.
                                Disfruta de la mejor selección en Andercode eCommerce.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Nav Tab Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="product-section-box m-0">
                        <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                    type="button" role="tab">Review</button>
                            </li>
                        </ul>

                        <div class="tab-content custom-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="product-description">
                                    <div class="nav-desh">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel">
                                <div class="review-box">
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <div class="product-rating-box">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="product-main-rating">
                                                            <h2>3.40
                                                                <i data-feather="star"></i>
                                                            </h2>

                                                            <h5>5 Overall Rating</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <ul class="product-rating-list">
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>5<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 40%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">2</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>4<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 20%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">1</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>3<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 0%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">0</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>2<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 20%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">1</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>1<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 20%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">1</h5>
                                                                </div>
                                                            </li>

                                                        </ul>

                                                        <div class="review-title-2">
                                                            <h4 class="fw-bold">Review this product</h4>
                                                            <p>Let other customers know what you think</p>
                                                            <button class="btn" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#writereview">Write a
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-7">
                                            <div class="review-people">
                                                <ul class="review-list">
                                                    <li>
                                                        <div class="people-box">
                                                            <div>
                                                                <div class="people-image people-text">
                                                                    <img alt="user" class="img-fluid "
                                                                        src="../assets/images/review/1.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="people-comment">
                                                                <div class="people-name"><a href="javascript:void(0)"
                                                                        class="name">Jack Doe</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content"> 29 Sep 2023
                                                                            06:40:PM
                                                                        </h6>
                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"></i>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reply">
                                                                    <p>Avoid this product. The quality is
                                                                        terrible, and
                                                                        it started falling apart almost
                                                                        immediately. I
                                                                        wish I had read more reviews before
                                                                        buying.
                                                                        Lesson learned.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="people-box">
                                                            <div>
                                                                <div class="people-image people-text">
                                                                    <img alt="user" class="img-fluid "
                                                                        src="../assets/images/review/2.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="people-comment">
                                                                <div class="people-name"><a href="javascript:void(0)"
                                                                        class="name">Jessica
                                                                        Miller</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content"> 29 Sep 2023
                                                                            06:34:PM
                                                                        </h6>
                                                                        <div class="product-rating">
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reply">
                                                                    <p>Honestly, I regret buying this item. The
                                                                        quality
                                                                        is subpar, and it feels like a waste of
                                                                        money. I
                                                                        wouldn't recommend it to anyone.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="people-box">
                                                            <div>
                                                                <div class="people-image people-text">
                                                                    <img alt="user" class="img-fluid "
                                                                        src="../assets/images/review/3.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="people-comment">
                                                                <div class="people-name"><a href="javascript:void(0)"
                                                                        class="name">Rome Doe</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content"> 29 Sep 2023
                                                                            06:18:PM
                                                                        </h6>
                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"></i>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reply">
                                                                    <p>I am extremely satisfied with this
                                                                        purchase. The
                                                                        item arrived promptly, and the quality
                                                                        is
                                                                        exceptional. It's evident that the
                                                                        makers paid
                                                                        attention to detail. Overall, a
                                                                        fantastic buy!
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="people-box">
                                                            <div>
                                                                <div class="people-image people-text">
                                                                    <img alt="user" class="img-fluid "
                                                                        src="../assets/images/review/4.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="people-comment">
                                                                <div class="people-name"><a href="javascript:void(0)"
                                                                        class="name">Sarah
                                                                        Davis</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content"> 29 Sep 2023
                                                                            05:58:PM
                                                                        </h6>
                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"></i>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reply">
                                                                    <p>I am genuinely delighted with this item.
                                                                        It's a
                                                                        total winner! The quality is superb, and
                                                                        it has
                                                                        added so much convenience to my daily
                                                                        routine.
                                                                        Highly satisfied customer!</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="people-box">
                                                            <div>
                                                                <div class="people-image people-text">
                                                                    <img alt="user" class="img-fluid "
                                                                        src="../assets/images/review/5.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="people-comment">
                                                                <div class="people-name"><a href="javascript:void(0)"
                                                                        class="name">John Doe</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content"> 29 Sep 2023
                                                                            05:22:PM
                                                                        </h6>
                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"></i>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reply">
                                                                    <p>Very impressed with this purchase. The
                                                                        item is of
                                                                        excellent quality, and it has exceeded
                                                                        my
                                                                        expectations.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Review Modal Start -->
    <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form class="product-review-form">
                        <div class="product-wrapper">
                            <div class="product-image">
                                <img class="img-fluid" alt="Solid Collared Tshirts"
                                    src="../assets/images/fashion/product/26.jpg">
                            </div>
                            <div class="product-content">
                                <h5 class="name">Solid Collared Tshirts</h5>
                                <div class="product-review-rating">
                                    <div class="product-rating">
                                        <h6 class="price-number">$16.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-box">
                            <div class="product-review-rating">
                                <label>Rating</label>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review-box">
                            <label for="content" class="form-label">Your Question *</label>
                            <textarea id="content" rows="3" class="form-control" placeholder="Your Question"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-md fw-bold text-light theme-bg-color">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Modal End -->
@endsection
