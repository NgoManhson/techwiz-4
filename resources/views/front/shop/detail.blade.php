@extends('front.layout.master')
@section('title', 'Shop Detail')
@section('body')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>product variable</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product details start-->
    <div class="product_details variable_product mt-100 mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="{{$product->productImages[0]->path}}" data-zoom-image="{{$product->productImages[0]->path}}" alt="big-0">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                @foreach($product->productImages as $key => $productImage)
                                    <li>
                                        <a class="elevatezoom-gallery {{ $key === 0 ? 'active' : '' }}" data-image="{{$productImage->path}}" data-zoom-image="{{$productImage->path}}">
                                            <img src="{{$productImage->path}}" alt="zo-th-{{$key}}" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form action="{{ url('/cart') }}" method="get">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <h1><a href="#">{{$product->name}}</a></h1>
{{--                            <div class="product_nav">--}}
{{--                                <ul>--}}
{{--                                    <li class="prev"><a href=""><i class="fa fa-angle-left"></i></a></li>--}}
{{--                                    <li class="next"><a href=""><i class="fa fa-angle-right"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                            <div class="product_ratting">
                                <ul>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li><a href="#"><i class="icon-star{{ $i <= $product->averageRating ? ' active' : '' }}"></i></a></li>
                                    @endfor
                                    <li class="review"><a href="#"> ({{ $product->reviewCount }} customer review ) </a></li>
                                </ul>
                            </div>

                            <div class="price_box">
                                <span class="current_price">${{$product->price}}</span>
                                <span class="old_price">${{$product->discount}}</span>
                            </div>

                            <div class="product_desc">
                                <p>{{$product->content}}</p>
                            </div>

                            <div class="product_variant color">
                                <h3>Options</h3>
                            </div>

                            <div class="product_variant size">
                                <label>Size</label>
                                @if($product->productDetails->isEmpty())
                                    <input disabled value="Out of stock">
                                @else
                                    <select class="select_option" id="size" name="product_size">
                                        @foreach ($product->productDetails->pluck('size')->unique() as $size)
                                            <option value="{{ $size }}" @if($loop->first) selected @endif>{{ $size }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <div class="product_variant quantity">
                                <label>Quantity</label>
                                @php
                                    $defaultSize = $product->productDetails->isEmpty() ? null : $product->productDetails->first()->size;
                                    $maxQuantity = $product->productDetails->where('size', $defaultSize)->first()->qty ?? 0;
                                @endphp
                                @if($maxQuantity > 0)
                                    <input id="quantityInput" value="1" type="number" min="1" max="{{ $maxQuantity }}">
                                @else
                                    <input disabled value="Out of stock">
                                @endif
                                <button class="button" type="submit">Add to Cart</button>
                            </div>

                        </form>

                        <div class=" product_d_action">
                            <ul>
                                <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                            </ul>
                        </div>

                        <div class="product_d_meta">
                            <span>SKU: {{$product->sku}}</span>
                            <span>Category: <a href="#">{{$product->productCategory->name}}</a></span>
                        </div>
                        <div class="priduct_social">
                            <ul>
                                <li><a class="facebook" href="" title="facebook"><i class="fa fa-facebook"></i>
                                        Like</a></li>
                                <li><a class="twitter" href="" title="twitter"><i class="fa fa-twitter"></i> tweet</a>
                                </li>
                                <li><a class="pinterest" href="" title="pinterest"><i class="fa fa-pinterest"></i>
                                        save</a></li>
                                <li><a class="google-plus" href="" title="google +"><i class="fa fa-google-plus"></i>
                                        share</a></li>
                                <li><a class="linkedin" href="" title="linkedin"><i class="fa fa-linkedin"></i>
                                        linked</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info mb-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button">
                            <ul class="nav" role="tablist" id="nav-tab">
                                <li>
                                    <a class="active" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info"
                                       aria-selected="false">Description</a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                       aria-selected="false">Specification</a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                       aria-selected="false">Reviews (1)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="product_info_content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec
                                        est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare
                                        lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus
                                        eu, suscipit id nulla.</p>
                                    <p>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis
                                        fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa
                                        massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit
                                        est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere
                                        nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et,
                                        luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sheet" role="tabpanel">
                                <div class="product_d_table">
                                    <form action="#">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="first_child">Compositions</td>
                                                <td>Polyester</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Styles</td>
                                                <td>Girly</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Properties</td>
                                                <td>Short Dress</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                        feminine designs delivering stylish separates and statement dresses which have
                                        since evolved into a full ready-to-wear collection in which every item is a
                                        vital part of a woman's wardrobe. The result? Cool, easy, chic looks with
                                        youthful elegance and unmistakable signature style. All the beautiful pieces are
                                        made in Italy and manufactured with the greatest attention. Now Fashion extends
                                        to a range of accessories including shoes, hats, belts and more!</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="reviews_wrapper">
                                    <h2>1 review for Donec eu furniture</h2>
                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="front/assets/img/blog/comment2.jpg" alt="">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <div class="star_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p><strong>admin </strong>- September 12, 2018</p>
                                                <span>roadthemes</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="comment_title">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published. Required fields are marked </p>
                                    </div>
                                    <div class="product_ratting mb-10">
                                        <h3>Your rating</h3>
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_review_form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="review_comment">Your review </label>
                                                    <textarea name="comment" id="review_comment"></textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="author">Name</label>
                                                    <input id="author" type="text">

                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="email">Email </label>
                                                    <input id="email" type="text">
                                                </div>
                                            </div>
                                            <button type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    <section class="product_area related_products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Related Products </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product_carousel product_column4 owl-carousel">
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product1.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-7%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">commodo augue nisi</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£69.00</span>
                                        <span class="old_price">£74.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product2.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-9%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">eget sagittis</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£65.00</span>
                                        <span class="old_price">£70.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product3.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-6%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">fringilla augue</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£68.00</span>
                                        <span class="old_price">£75.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product4.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-5%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">massa massa</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£75.00</span>
                                        <span class="old_price">£80.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product5.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-8%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">placerat vestibulum</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£65.00</span>
                                        <span class="old_price">£70.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product6.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-9%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Porro Cook</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£62.00</span>
                                        <span class="old_price">£68.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->

    <!--product area start-->
    <section class="product_area upsell_products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Upsell Products </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product_carousel product_column4 owl-carousel">
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product7.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-4%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">sapien libero</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£69.00</span>
                                        <span class="old_price">£74.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product8.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-6%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">vulputate rutrum</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£64.00</span>
                                        <span class="old_price">£72.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product9.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-8%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">adipiscing cursus</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£60.00</span>
                                        <span class="old_price">£70.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product10.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-9%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Donec eu cook</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£67.00</span>
                                        <span class="old_price">£77.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product1.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-7%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">commodo augue nisi</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£69.00</span>
                                        <span class="old_price">£74.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="front/assets/img/product/product2.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-9%</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i
                                                        class="icon-shopping-bag"></i></a></li>
                                            <li class="compare"><a href="#" title="Add to Compare"><i
                                                        class="icon-sliders"></i></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                        class="icon-heart"></i></a></li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view"> <i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">eget sagittis</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£65.00</span>
                                        <span class="old_price">£70.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->


    <!--brand area start-->
    <div class="brand_area brand__three">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand_container owl-carousel">
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand1.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand2.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand3.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand4.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand5.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand6.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="front/assets/img/brand/brand2.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--brand area end-->
@endsection
<style>
    /* Icon mặc định (không active) */
    .icon-star {
        color: #ccc;
    }

    /* Icon active (có điểm đánh giá) */
    .icon-star.active {
        color: #ffca08;
    }
</style>