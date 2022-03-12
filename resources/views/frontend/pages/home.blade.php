@extends('frontend.app')
@section('title', 'Home')
@section('homecontent')
    <!-- Carousel Start -->
    <div class="carousel">
        <div class="wrapper">
            <div class="owl-carousel">
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('frontend/img') }}/carousel-1.jpg" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>LAUNDRY SERVICE</h3>
                        <h1>Let Us Do It For You</h1>
                        {{-- <p>
                            Lorem ipsum dolor sit amet elit. Phasellus ut mollis mauris. Vivamus egestas eleifend dui ac
                        </p> --}}
                        <a class="btn btn-custom" href="">Schedule Pickup</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('frontend/img') }}/carousel-2.jpg" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Detailing</h3>
                        <h1>Quality service for you</h1>
                        <p>
                            Morbi sagittis turpis id suscipit feugiat. Suspendisse eu augue urna. Morbi sagittis orci
                            sodales
                        </p>
                        <a class="btn btn-custom" href="">Explore More</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('frontend/img') }}/carousel-3.jpg" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Detailing</h3>
                        <h1>Exterior & Interior Washing</h1>
                        <p>
                            Sed ultrices, est eget feugiat accumsan, dui nibh egestas tortor, ut rhoncus nibh ligula euismod
                            quam
                        </p>
                        <a class="btn btn-custom" href="">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Start Quick Service -->
    <div class="quick-order">
        <div class="container">
            <div class="section-header text-center">
                <h2>Quick Online Order - Only take 3 minutes</h2>
            </div>


            <style>
                #id_work_days input[type="checkbox"] {
                    display: none;
                }

                #id_work_days span {
                    display: inline-block;
                    padding: 11px;
                    border: 2px solid gold;
                    border-radius: 3px;
                    color: gold;
                    width: 200px;
                    text-align: center;
                    font-weight: 600;
                    font-size: 18px;
                }

                #id_work_days input[type="checkbox"]:checked+span {
                    background-color: gold;
                    color: black;
                }

            </style>

            <div class="row">



                <div id="quick-service-item">
                    <p id="id_work_days">
                        <label><input type="checkbox" name="work_days" value="1"><span>Laundry</span></label>
                        <label><input type="checkbox" name="work_days" value="2"><span>Dry Cleaning</span></label>
                        <label><input type="checkbox" name="work_days" value="3"><span>Home Cleaning</span></label>
                        <label><input type="checkbox" name="work_days" value="4"><span>Premium Laundry</span></label>
                    </p>
                </div>



                <div class="quick-service-city">

                    <style>
                        select {

                            /* styling */
                            background-color: white;
                            border: thin solid gold;
                            border-radius: 4px;
                            display: inline-block;
                            font: inherit;
                            line-height: 1.5em;
                            /* padding: 0.5em 3.5em 0.5em 1em; */
                            padding: 12.5px 20px;

                            /* reset */

                            margin: 0;
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;
                            -webkit-appearance: none;
                            -moz-appearance: none;
                        }


                        /* arrows */

                        select.classic {
                            background-image:
                                linear-gradient(45deg, transparent 50%, gold 50%),
                                linear-gradient(135deg, gold 50%, transparent 50%),
                                linear-gradient(to right, goldenrod, goldenrod);
                            background-position:
                                calc(100% - 20px) calc(1em + 7px),
                                calc(100% - 15px) calc(1em + 7px),
                                100% 0;
                            background-size:
                                5px 5px,
                                5px 5px,
                                2.5em 3.5em;
                            background-repeat: no-repeat;
                            border: 2px solid gold;
                            color: gold;
                            font-weight: 600;
                        }

                        select.classic:focus {
                            background-image:
                                linear-gradient(45deg, goldenrod 50%, transparent 50%),
                                linear-gradient(135deg, transparent 50%, goldenrod 50%),
                                linear-gradient(to right, gold, gold);
                            background-position:
                                calc(100% - 15px) 1em,
                                calc(100% - 20px) 1em,
                                100% 0;
                            background-size:
                                5px 5px,
                                5px 5px,
                                2.5em 2.5em;
                            background-repeat: no-repeat;
                            border-color: gold;
                            outline: 0;
                        }

                        select:-moz-focusring {
                            color: transparent;
                            text-shadow: 0 0 0 goldenrod;
                        }


                        h1 {
                            color: white;
                            line-height: 120%;
                            margin: 0 auto 2rem auto;
                            max-width: 30rem;
                        }

                    </style>

                    <select class="classic">
                        <option>CSS SELECT arrow (classic)</option>
                        <option>No external background image</option>
                        <option>No wrapper</option>
                    </select>


                </div>


                <div class="quick-service-location">

                    <style>
                        input#frontLocation {
                            padding: 10px 20px;
                            font-size: 18px;
                            font-weight: 600;
                            border-radius: 4px;
                            border: 2px solid gold;
                        }


                        ::placeholder {
                            color: gold;
                            opacity: 1;
                            /* Firefox */
                        }

                        :-ms-input-placeholder {
                            /* Internet Explorer 10-11 */
                            color: gold;
                        }

                        ::-ms-input-placeholder {
                            /* Microsoft Edge */
                            color: gold;
                        }

                        button#frontBtn {
                            padding: 12px 20px;
                            border-radius: 4px;
                            border: 2px solid gold;
                            background: #ffffff;
                            color: gold;
                            font-weight: 600;
                        }

                        button#frontBtn:focus {
                            outline: 1px solid gold;
                        }

                    </style>

                    <input id="frontLocation" type="text" id="fname" name="fname" placeholder="Location">
                </div>
                <div class="quick-service-button">
                    <button id="frontBtn" type="button">Schedule FREE Pick-Up</button>
                </div>

            </div>

        </div>
    </div>

    <!-- End Start Quick Service -->


    <!-- About Start -->
  
    <!-- About End -->


    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header text-center">
                <p>What We Do?</p>
                <h2>Premium Washing Services</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash-1"></i>
                        <h3>Exterior Washing</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash"></i>
                        <h3>Interior Washing</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-vacuum-cleaner"></i>
                        <h3>Vacuum Cleaning</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-seat"></i>
                        <h3>Seats Washing</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-service"></i>
                        <h3>Window Wiping</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-service-2"></i>
                        <h3>Wet Cleaning</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash"></i>
                        <h3>Oil Changing</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-brush-1"></i>
                        <h3>Brake Reparing</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Facts Start -->
    <div class="facts" data-parallax="scroll" data-image-src="{{ asset('frontend/img') }}/facts.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-map-marker-alt"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">25</h3>
                            <p>Service Points</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-user"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">350</h3>
                            <p>Engineers & Workers</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-users"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">1500</h3>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-check"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">5000</h3>
                            <p>Projects Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Price Start -->
    <div class="price">
        <div class="container">
            <div class="section-header text-center">
                <p>Washing Plan</p>
                <h2>Choose Your Plan</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="price-item">
                        <div class="price-header">
                            <h3>Basic Cleaning</h3>
                            <h2><span>$</span><strong>25</strong><span>.99</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-times-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-times-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <a class="btn btn-custom" href="">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="price-item featured-item">
                        <div class="price-header">
                            <h3>Premium Cleaning</h3>
                            <h2><span>$</span><strong>35</strong><span>.99</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-times-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <a class="btn btn-custom" href="">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="price-item">
                        <div class="price-header">
                            <h3>Complex Cleaning</h3>
                            <h2><span>$</span><strong>49</strong><span>.99</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <a class="btn btn-custom" href="">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Price End -->


    <!-- Location Start -->
    <div class="location">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="section-header text-left">
                        <p>Washing Points</p>
                        <h2>Car Washing & Care Points</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Car Washing Point</h3>
                                    <p>123 Street, New York, USA</p>
                                    <p><strong>Call:</strong>+012 345 6789</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Car Washing Point</h3>
                                    <p>123 Street, New York, USA</p>
                                    <p><strong>Call:</strong>+012 345 6789</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Car Washing Point</h3>
                                    <p>123 Street, New York, USA</p>
                                    <p><strong>Call:</strong>+012 345 6789</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Car Washing Point</h3>
                                    <p>123 Street, New York, USA</p>
                                    <p><strong>Call:</strong>+012 345 6789</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="location-form">
                        <h3>Request for a car wash</h3>
                        <form>
                            <div class="control-group">
                                <input type="text" class="form-control" placeholder="Name" required="required" />
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" placeholder="Email" required="required" />
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" placeholder="Description" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-custom" type="submit">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location End -->


    <!-- Team Start -->
    <div class="team">
        <div class="container">
            <div class="section-header text-center">
                <p>Meet Our Team</p>
                <h2>Our Engineers & Workers</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img') }}/team-1.jpg" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Donald John</h2>
                            <p>Engineer</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img') }}/team-2.jpg" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Adam Phillips</h2>
                            <p>Engineer</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img') }}/team-3.jpg" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Thomas Olsen</h2>
                            <p>Worker</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img') }}/team-4.jpg" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>James Alien</h2>
                            <p>Worker</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="section-header text-center">
                <p>Testimonial</p>
                <h2>What our clients say</h2>
            </div>
            <div class="owl-carousel testimonials-carousel">
                <div class="testimonial-item">
                    <img src="{{ asset('frontend/img') }}/testimonial-1.jpg" alt="Image">
                    <div class="testimonial-text">
                        <h3>Client Name</h3>
                        <h4>Profession</h4>
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus
                            tortor auctor gravid
                        </p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="{{ asset('frontend/img') }}/testimonial-2.jpg" alt="Image">
                    <div class="testimonial-text">
                        <h3>Client Name</h3>
                        <h4>Profession</h4>
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus
                            tortor auctor gravid
                        </p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="{{ asset('frontend/img') }}/testimonial-3.jpg" alt="Image">
                    <div class="testimonial-text">
                        <h3>Client Name</h3>
                        <h4>Profession</h4>
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus
                            tortor auctor gravid
                        </p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="{{ asset('frontend/img') }}/testimonial-4.jpg" alt="Image">
                    <div class="testimonial-text">
                        <h3>Client Name</h3>
                        <h4>Profession</h4>
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus
                            tortor auctor gravid
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="blog">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Blog</p>
                <h2>Latest news & articles</h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('frontend/img') }}/blog-1.jpg" alt="Image">
                            <div class="meta-date">
                                <span>01</span>
                                <strong>Jan</strong>
                                <span>2045</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam eleife.
                                Nam in arcu sit amet massa ferment quis enim. Nunc augue velit metus congue eget semper
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                            <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                            <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('frontend/img') }}/blog-2.jpg" alt="Image">
                            <div class="meta-date">
                                <span>01</span>
                                <strong>Jan</strong>
                                <span>2045</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam eleife.
                                Nam in arcu sit amet massa ferment quis enim. Nunc augue velit metus congue eget semper
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                            <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                            <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('frontend/img') }}/blog-3.jpg" alt="Image">
                            <div class="meta-date">
                                <span>01</span>
                                <strong>Jan</strong>
                                <span>2045</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam eleife.
                                Nam in arcu sit amet massa ferment quis enim. Nunc augue velit metus congue eget semper
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                            <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                            <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
