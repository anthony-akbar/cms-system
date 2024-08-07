@section('title', $product->title)
{{--@section('description', $product->seo_description)--}}
@section('keyword', "$product->seo_title")
@section('style')
    <style>
        .flash-message{
            top: 100px;
            right: 10px;
            opacity: 1;
            transition: 0.2s;
            position: fixed !important;
            z-index: 999;
        }
        .hiddenmsg{
            right: -500px;
            opacity: 0;
            transition: 1s;
            position: fixed;
        }
        @media only screen and (max-width: 767px) {
            .priceBuy{
                width: 100%;
                position: fixed;
                bottom: 0;
                z-index: 9998;
                background-color: white;
                left: 0;
                right: 0;
                padding: 20px;
            }
            .icon-input {
                top: 0;
                right: 0;
                padding: 12px 15px;
            }
            footer{
                padding-bottom: 105px;
            }
            #scrollUp{
                bottom: 160px;
            }
        }
        @media screen and (max-width: 2000px) and (min-width: 1200px) {
            .product-wrap .product-img {
                height: 310px;
            }
        }
        @media only screen and (max-width: 991px) {
            .product-wrap .product-img {
                height: 235px;
            }
        }
        @media only screen and (max-width: 767px) {
            .product-wrap .product-img {
                height: 265px;
            }
        }
        @media only screen and (max-width: 576px) {
            .product-wrap .product-img {
                height: 510px;
            }
        }
        @media only screen and (max-width: 500px) {
            .product-wrap .product-img {
                height: 430px;
            }
        }
        @media only screen and (max-width: 400px) {
            .product-wrap .product-img {
                height: 430px;
            }
        }
    </style>
@endsection

<div>
    <div class="hiddenmsg bg-success flash-message position-absolute text-white px-4 py-2 rounded shadow fs-4">
        Заказ получен, мы вам перезвоним в ближайшее время.
    </div>
    <div class="product-details-area pb-100 pt-100">
        <div class="container">
            <div class="row mx-0">
                <div class="col-12 d-md-block d-none mb-5"><a href="/">Главная</a> /
                    <a class="" href="{{ route('front.category.index') }}">Каталог</a> /
                    <a class="" href="{{ route('front.category.show', $product->categories[0]->slug) }}">{{$product->categories[0]->title}}</a>
                </div>
                <div class="col-12 d-md-none mb-5 d-flex">
                    <a onclick="goBack()">
                        <div class="">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="20" fill="#F4F4F4"/>
                                <path d="M25.3333 20H14.6666M14.6666 20L18.6666 16M14.6666 20L18.6666 24" stroke="#232323" stroke-width="0.895828" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </a>
                    <a href="/" class="font-kyiv p-2 ms-3 fs-5">Магазин</a>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-img-wrap product-details-vertical-wrap" data-aos="fade-up" data-aos-delay="50">
                        <div class="product-details-small-img-wrap">
                            <div class="swiper-container product-details-small-img-slider-1 pd-small-img-style">
                                <div class="swiper-wrapper">
                                    @foreach($product->images as $image)
                                        <div class="swiper-slide">
                                            <div class="product-details-small-img">
                                                <img src="{{asset('storage/'.$image->image)}}" alt="{{$image->alt}}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pd-prev pd-nav-style"> <i class="ti-angle-up"></i></div>
                            <div class="pd-next pd-nav-style"> <i class="ti-angle-down"></i></div>
                        </div>
                        <div class="swiper-container product-details-big-img-slider-1 pd-big-img-style">
                            <div class="swiper-wrapper">
                                @foreach($product->images as $image)
                                    <div class="swiper-slide">
                                        <div class="">
                                            <div class="">
                                                <a class="img-popup" href="{{asset('storage/'.$image->image)}}">
                                                    <img class="w-100" src="{{asset('storage/'.$image->image)}}" alt="{{$image->alt}}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-content" data-aos="fade-left" data-aos-delay="50">
                        <div class="d-flex">
                            <h2 class="font-cormorant fw-bold h1 image{{$product->id}}">{{$product->title}}</h2>
                            <div style="width: 20%" class="h4 d-flex align-items-center justify-content-around flex-column">
                                <div class="">
                                    @livewire('front.wishlist.wishlist-button', ['product' => $product], key($product->id))
                                </div>
                                <div class="single-product-compare">
{{--                                    <a title="Compare" href="#"><i class="pe-7s-shuffle"></i></a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="product-details-review pt-4">
                            <div class="product-rating">
                                <i class=" ti-star"></i>
                                <i class=" ti-star"></i>
                                <i class=" ti-star"></i>
                                <i class=" ti-star"></i>
                                <i class=" ti-star"></i>
                            </div>
{{--                            <span>8 отзывов</span>--}}
                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li>{{$product->short_description}}</li>
                                <li><span class="title">Теги:</span>
                                    <ul >
                                        @foreach($product->tags as $tag)
                                            <li ><a class="" href="{{ route('front.category.index', ['tagId' => $tag->id]) }}">{{$tag->title}}</a>,</li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><span class="title">Категории:</span>
                                    <ul class="tag">
                                        <li>
                                            @foreach($product->categories as $category)
                                                <a class="" href="{{ route('front.category.show', $category->slug) }}">{{$category->title}}</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </li>
                                <li><span class="title">Доступность:</span>
                                    <ul class="tag">
                                        {!! ($product->amount) ? '<li class="text-success">Есть в наличии '.$product->amount.' шт.</li>' : '<li class="text-danger">Нет в наличии</li>' !!}
                                    </ul>
                                </li>
                            </ul>
                        </div>
{{--                        <div class="product-color product-color-active product-details-color">--}}
{{--                            <span>Color :</span>--}}
{{--                            <ul>--}}
{{--                                <li><a title="Pink" class="pink rounded-circle" href="#">pink</a></li>--}}
{{--                                <li><a title="Yellow" class="active yellow rounded-circle" href="#">yellow</a></li>--}}
{{--                                <li><a title="Purple" class="purple rounded-circle" href="#">purple</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        @if($product->amount > 0)
                            <div class="">
                                <div class="w-50 pe-1">
                                    @livewire('front.cart.cart-count-btn', ['product' => $product, 'type' => 'cart_count'], key($product->id))
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="priceBuy">
                        <div class="product-details-action-wrap font-kyiv">
                            <div class="product-details-price py-md-3">
                                <span class="p-1 {{($product->discount_price == "") ? 'd-none' : 'new-price'}}">{{number_format($product->discount_price, 0, '.', ' ')}}  {{$product->discount_price > 999 ? 'сум' : '$'}}</span>
                                <span class="p-1 {{($product->discount_price == "") ? 'new-price' : 'old-price'}}">{{number_format($product->price, 0, '.', ' ')}} {{$product->price > 999 ? 'сум' : '$'}}</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            @if($product->amount > 0)
                                <div class="w-50 pe-1">
                                    @livewire('front.cart.cart-count-btn', ['product' => $product, 'type' => 'cart'], key($product->id))
                                </div>
                            @endif
                            <div class="single-product-cart btn-hover w-50 ps-1 text-center">
                                <button title="Купить в один клик" data-bs-toggle="modal" data-bs-target="#exampleModal" class="w-100 p-3 text-dark bg-light border border-1">{{($product->amount > 0) ? 'Купить в один клик' : 'Оставить заявку' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade quickview-modal-style" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <livewire:front.component.onclick :product="$product" :key="$product->id" />
            </div>
        </div>
    </div>
    <div class="description-review-area pb-85">
        <div class="container">
            <div class="description-review-topbar nav" data-aos="fade-down" data-aos-delay="50">
                <a class="active" data-bs-toggle="tab" href="#des-details2" class=""> Характеристики </a>
                <a data-bs-toggle="tab" href="#des-details1"> Описание </a>
                <a data-bs-toggle="tab" href="#des-details3" class=""> Отзывы </a>
            </div>
            <div class="tab-content">
                <div id="des-details2" class="tab-pane active">
                    <div class="specification-wrap table-responsive d-flex justify-content-center">
                        {!! $product->additional !!}
                    </div>
                </div>
                <div id="des-details1" class="tab-pane">
                    {!! $product->long_description !!}
                </div>
{{--                <div id="des-details3" class="tab-pane">--}}
{{--                    <div class="review-wrapper">--}}
{{--                        <h3>1 review for Sleeve Button Cowl Neck</h3>--}}
{{--                        <div class="single-review">--}}
{{--                            <div class="review-img">--}}
{{--                                <img src="{{asset('no_photo.jpg')}}" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="review-content">--}}
{{--                                <div class="review-rating">--}}
{{--                                    <a href="#"><i class="ti-star"></i></a>--}}
{{--                                    <a href="#"><i class="ti-star"></i></a>--}}
{{--                                    <a href="#"><i class="ti-star"></i></a>--}}
{{--                                    <a href="#"><i class="ti-star"></i></a>--}}
{{--                                    <a href="#"><i class="ti-star"></i></a>--}}
{{--                                </div>--}}
{{--                                <h5><span>HasTech</span> - April 29, 2022</h5>--}}
{{--                                <p>Donec accumsan auctor iaculis. Sed suscipit arcu ligula, at egestas magna molestie a. Proin ac ex maximus, ultrices justo eget, sodales orci. Aliquam egestas libero ac turpis pharetra, in vehicula lacus scelerisque</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="ratting-form-wrapper">--}}
{{--                        <h3>Add a Review</h3>--}}
{{--                        <p>Your email address will not be published. Required fields are marked <span>*</span></p>--}}
{{--                        <div class="your-rating-wrap">--}}
{{--                            <span>Your rating</span>--}}
{{--                            <div class="your-rating">--}}
{{--                                <a href="#"><i class="ti-star"></i></a>--}}
{{--                                <a href="#"><i class="ti-star"></i></a>--}}
{{--                                <a href="#"><i class="ti-star"></i></a>--}}
{{--                                <a href="#"><i class="ti-star"></i></a>--}}
{{--                                <a href="#"><i class="ti-star"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="ratting-form">--}}
{{--                            <form action="#">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6 col-md-6">--}}
{{--                                        <div class="rating-form-style mb-15">--}}
{{--                                            <label>Name <span>*</span></label>--}}
{{--                                            <input type="text">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-6 col-md-6">--}}
{{--                                        <div class="rating-form-style mb-15">--}}
{{--                                            <label>Email <span>*</span></label>--}}
{{--                                            <input type="email">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="rating-form-style mb-15">--}}
{{--                                            <label>Your review <span>*</span></label>--}}
{{--                                            <textarea name="Your Review"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12">--}}
{{--                                        <div class="save-email-option">--}}
{{--                                            <p><input type="checkbox"> <label>Save my name, email, and website in this browser for the next time I comment.</label></p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <div class="form-submit">--}}
{{--                                            <input type="submit" value="Submit">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    @if(count($relatedProducts) > 0)
        <div class="related-product-area pb-95">
            <div class="container">
                <div class="pt-3 mb-75 font-cormorant position-relative" data-aos="fade-up" data-aos-delay="50">
                    <h2 class="shadow-text-1 font-cormorant fw-bold">В одном <br>стиле</h2>
                    <h2 class="shadow-text-2 font-cormorant fw-bold">В одном <br>стиле</h2>
                </div>
                <div class="product-slider-active-1 pt-0 swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($relatedProducts as $product)
                            <div class="swiper-slide align-self-stretch">
                                <livewire:front.component.product-card :product="$product" :key="$product->id" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($additionalProducts) > 0)
        <div class="related-product-area pb-95">
            <div class="container">
                <div class="pt-3 mb-75 font-cormorant position-relative" data-aos="fade-up" data-aos-delay="50">
                    <h2 class="shadow-text-1 font-cormorant fw-bold">Покупают с<br>этим</h2>
                    <h2 class="shadow-text-2 font-cormorant fw-bold">Покупают с<br>этим</h2>
                </div>
                <div class="product-slider-active-1 pt-0 swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($additionalProducts as $product)
                            <div class="swiper-slide align-self-stretch">
                                <livewire:front.component.product-card :product="$product" :key="$product->id" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


@section('scripts')
    <script>
        function goBack() {
            window.history.back();
        }


    </script>
@endsection
