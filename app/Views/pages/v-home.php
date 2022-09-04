<?= $this->extend('pages/config/template'); ?>

<?= $this->section('main'); ?>

<!-- Slider area starts -->
<section id="slider" class="slider-area">

    <div id="carousel-example-generic" class="carousel slide carousel-fade">

        <div class="carousel-inner" role="listbox">

            <!-- Item 1 -->
            <div class="item active">
                <div class="table">
                    <div class="table-cell">
                        <div class="intro-text">
                            <div class="container">
                                <div class="row">

                                    <!-- intro image -->
                                    <div class="col-md-6 col-md-push-6 col-sm-12 intro-img">
                                        <img src="assets/img/slider/1.jpg" alt="">
                                    </div>
                                    <!-- intro text -->
                                    <div class="col-md-6 col-md-pull-6 col-sm-12">
                                        <h1>High Performance in <br>
                                            Wide Area is Our Gurantee.</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                        <a href="#" class="btn btn-trnsp">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="item">
                <div class="table">
                    <div class="table-cell">
                        <div class="intro-text">
                            <div class="container">
                                <div class="row">

                                    <!-- intro image -->
                                    <div class="col-md-6 col-sm-12 intro-img" id="intro-img">
                                        <img src="assets/img/slider/1.png" alt="">
                                    </div>

                                    <!-- intro text -->
                                    <div class="col-md-6 col-sm-12">
                                        <h1>High Performance in <br>
                                            Wide Area is Our Gurantee.</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                        <a href="#" class="btn btn-trnsp">Read More</a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Wrapper for slides-->


        <!-- Carousel Pagination -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>


        <!-- Slider left right button -->
        <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <img src="assets/img/left-arrow.png" alt="">
            </a>

            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <img src="assets/img/right-arrow.png" alt="">
            </a> -->

    </div>

    <!-- bootstrap carousel -->
</section>

<!-- Features area start -->
<section id="features" class="features-area section-big">
    <div class="container">

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Super Unique Features</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="features-box">
                    <span class="ti-server"></span>
                    <h3>Website Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore eiusmod tempor labore dolore.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="features-box">
                    <span class="ti-ruler-pencil"></span>
                    <h3>VPS Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore eiusmod tempor labore dolore.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="features-box">
                    <span class="ti-thought"></span>
                    <h3>Could Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore eiusmod tempor labore dolore.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="features-box">
                    <span class="ti-harddrives"></span>
                    <h3>Website Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore eiusmod tempor labore dolore.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="features-box">
                    <span class="ti-package"></span>
                    <h3>VPS Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore eiusmod tempor labore dolore.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="features-box">
                    <span class="ti-cup"></span>
                    <h3>Could Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore eiusmod tempor labore dolore.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features area end -->

<!-- price area start -->
<section class="price-area section-big">
    <div class="container">

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Choose the Convenient Pricing</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <ul class="nav-tab">
                    <li><a href="#month" data-toggle="tab">Build Monthly</a></li>
                    <li class="active"><a href="#annual" data-toggle="tab">Build Annualy</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container" id="tab-container">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="annual">
                    <!-- Comparison Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="comparison" data-connectors="1">
                            <div class="comparison-info">
                                <h3>Comparison Table</h3>
                                <p>Check out your price</p>
                                <a href="" class="btn">Custom Price</a>
                            </div>
                            <div class="features">
                                <ul>
                                    <li>User Limit</li>
                                    <li>Total Projects</li>
                                    <li>Website</li>
                                    <li>Storage</li>
                                    <li>Domain</li>
                                    <li>24/7 Support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Price Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="price-item" data-connectors="2">
                            <div class="price-info">
                                <h3>Starter</h3>
                                <p>For Individuals</p>
                                <p class="price">$15.99</p>
                            </div>
                            <div class="features">
                                <ul>
                                    <li>05</li>
                                    <li>10</li>
                                    <li>01</li>
                                    <li>500 GB SSD</li>
                                    <li>03</li>
                                    <li>Included</li>
                                </ul>
                            </div>
                            <a href="" class="btn">Start Trial</a>
                        </div>
                    </div>
                    <!-- Price Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="price-featured" data-connectors="3">
                            <div class="price-info-featured">
                                <h3>Business</h3>
                                <p>For Small Companies</p>
                                <p class="price">$30.99</p>
                                <a href="" class="favo-btn">Most Favourite</a>
                            </div>
                            <div class="featured-features">
                                <ul>
                                    <li>10</li>
                                    <li>25</li>
                                    <li>03</li>
                                    <li>2 TB SSD</li>
                                    <li>05</li>
                                    <li>Included</li>
                                </ul>
                            </div>
                            <a href="" class="btn active">Start Trial</a>
                        </div>
                    </div>
                    <!-- Price Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="price-item" data-connectors="4">
                            <div class="price-info">
                                <h3>Enterprise</h3>
                                <p>For Large Companies</p>
                                <p class="price">$45.99</p>
                            </div>
                            <div class="features">
                                <ul>
                                    <li>Unlimited</li>
                                    <li>Unlimited</li>
                                    <li>10</li>
                                    <li>Unlimited</li>
                                    <li>15</li>
                                    <li>Included</li>
                                </ul>
                            </div>
                            <a href="" class="btn">Start Trial</a>
                        </div>
                    </div>

                </div><!-- Tab one end-->
                <div class="tab-pane fade" id="month">
                    <!-- Comparison Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="comparison" data-connectors="5">
                            <div class="comparison-info">
                                <h3>Comparison Table</h3>
                                <p>Check out your price</p>
                                <a href="" class="btn">Custom Price</a>
                            </div>
                            <div class="features">
                                <ul>
                                    <li>User Limit</li>
                                    <li>Total Projects</li>
                                    <li>Website</li>
                                    <li>Storage</li>
                                    <li>Domain</li>
                                    <li>24/7 Support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Price Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="price-item" data-connectors="6">
                            <div class="price-info">
                                <h3>Starter</h3>
                                <p>For Individuals</p>
                                <p class="price">$9.99</p>
                            </div>
                            <div class="features">
                                <ul>
                                    <li>05</li>
                                    <li>10</li>
                                    <li>01</li>
                                    <li>500 GB SSD</li>
                                    <li>03</li>
                                    <li>Included</li>
                                </ul>
                            </div>
                            <a href="" class="btn">Start Trial</a>
                        </div>
                    </div>
                    <!-- Price Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="price-featured" data-connectors="7">
                            <div class="price-info-featured">
                                <h3>Business</h3>
                                <p>For Small Companies</p>
                                <p class="price">$19.99</p>
                                <a href="" class="favo-btn">Most Favourite</a>
                            </div>
                            <div class="featured-features">
                                <ul>
                                    <li>10</li>
                                    <li>25</li>
                                    <li>03</li>
                                    <li>2 TB SSD</li>
                                    <li>05</li>
                                    <li>Included</li>
                                </ul>
                            </div>
                            <a href="" class="btn active">Start Trial</a>
                        </div>
                    </div>
                    <!-- Price Table -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="price-item" data-connectors="8">
                            <div class="price-info">
                                <h3>Enterprise</h3>
                                <p>For Large Companies</p>
                                <p class="price">$29.99</p>
                            </div>
                            <div class="features">
                                <ul>
                                    <li>Unlimited</li>
                                    <li>Unlimited</li>
                                    <li>10</li>
                                    <li>Unlimited</li>
                                    <li>15</li>
                                    <li>Included</li>
                                </ul>
                            </div>
                            <a href="" class="btn">Start Trial</a>
                        </div>
                    </div>

                </div><!-- Tab Two end-->
            </div>
        </div>
    </div>


</section>
<!-- price area end -->

<!-- Data area start -->
<section class="data-area section-big">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Data Centers Around the World</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="data-img">
            <img src="assets/img/bg/map.png" alt="">
            <div class="data-box">
                <span class="ti-harddrives"></span>
                <h3>Singapore Datacenter</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore.</p>
                <a href="" class="btn active"> View Details</a>
            </div>


        </div>
    </div>
</section>
<!-- Data area end -->

<!-- Testamonial area start -->
<section id="testamonial" class="testimonial-area section-big">

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>What Customers Say About Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="testimonial">
                <div class="testimonial-box">
                    <img src="assets/img/testi/4.png" alt="">
                    <h3>Emiley Blunt</h3>
                    <p>Google inc.</p>
                    <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-box">
                    <img src="assets/img/testi/1.png" alt="">
                    <h3>John Doe</h3>
                    <p>Google inc.</p>
                    <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-box">
                    <img src="assets/img/testi/2.png" alt="">
                    <h3>Mr. Maxwell</h3>
                    <p>Google inc.</p>
                    <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-box hidden-sm hidden-xs">
                    <img src="assets/img/testi/3.png" alt="">
                    <h3>Emiley Blunt</h3>
                    <p>Google inc.</p>
                    <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <p class="testimonial-text">
                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam"
                </p>
            </div>


        </div>
    </div>
</section>
<!-- Testamonial area end -->

<!-- Services area start -->
<section id="service" class="service-area section-big">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Our Offered Services</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="service-box">
                    <img src="assets/img/services/1.png" alt="">
                    <h3>Website Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="" class="btn">Get it Now</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="service-box">
                    <img src="assets/img/services/2.png" alt="">
                    <h3>VPS Hosting</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="" class="btn">Get it Now</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="service-box">
                    <img src="assets/img/services/3.png" alt="">
                    <h3>Website Security</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="" class="btn">Get it Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services area end -->


<!-- Search area start -->
<section id="search" class="search-area section-big">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Find a Smart Domain That Suits You</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="search-box">
                    <input type="search" name="search" placeholder="Search your domain">
                    <div class="input-text">.com <span class="ti-arrow-down"></span></div>
                    <button class="btn active"><span class="ti-search"></span> Search</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Search area end -->

<!-- Client area starts -->
<section id="client" class="client-area section-big">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Brands That Already With Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <!-- client carousel -->
        <div class="owl-client">

            <!-- item 1 -->
            <div class="item active text-center">
                <img src="assets/img/clients/1.png" alt="">
            </div>

            <!-- item 2 -->
            <div class="item active text-center">
                <img src="assets/img/clients/2.png" alt="">
            </div>

            <!-- item 3 -->
            <div class="item active text-center">
                <img src="assets/img/clients/3.png" alt="">
            </div>

            <!-- item 4 -->
            <div class="item active text-center">
                <img src="assets/img/clients/4.png" alt="">
            </div>

            <!-- item 5 -->
            <div class="item active text-center">
                <img src="assets/img/clients/5.png" alt="">
            </div>

            <!-- item 6 -->
            <div class="item active text-center">
                <img src="assets/img/clients/6.png" alt="">
            </div>

            <!-- item 7 -->
            <div class="item active text-center">
                <img src="assets/img/clients/7.png" alt="">
            </div>

            <!-- item 8 -->
            <div class="item active text-center">
                <img src="assets/img/clients/8.png" alt="">
            </div>

            <!-- item 9 -->
            <div class="item active text-center">
                <img src="assets/img/clients/9.png" alt="">
            </div>

        </div>
        <!-- / client carousel -->

    </div>
</section>
<!-- Client area ends -->

<?= $this->endSection(); ?>