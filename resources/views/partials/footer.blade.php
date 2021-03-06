<footer class="footer" id="myfooter">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>

                                <ul class="links">
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">My Account</a></li>
                                    <li><a href="javascript:void(0)">Orders History</a></li>
                                    <li><a href="javascript:void(0)">Advanced Search</a></li>
                                    <li><a href="javascript:void(0)" class="login-link">Login</a></li>
                                </ul>
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-3 -->

                        <div class="col-md-5">
                            <div class="widget">
                                    <h4 class="widget-title">Contact</h4>
                                <ul class="contact-info">
                                    <li>
                                        <span class="contact-info-label">Address:</span>{{$setting->address}}
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Phone:</span><a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Mobile:</span><a href="tel:{{$setting->phone2}}">{{$setting->phone2}}</a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Email:</span> <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Working Days/Hours:</span>
                                        Sun - Fri / 9:00AM - 8:00PM
                                    </li>
                                </ul>
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-5">
                            <div class="widget">
                                <h4 class="widget-title">Our Sister Concerns</h4>
                                
                                <ul class="links">
                                    <li><a href="http://www.khatrygroups.com" target="_blank">Khatry Groups</a></li>
                                    <li><a href="http://www.khatry.co.uk" target="_blank">Khatry & Co UK Pvt. Ltd.</a></li>
                                    <li><a href="#" target="_blank">Khatry & Pradhan USA Pvt.Ltd</a></li>
                                    <li><a href="#" target="_blank">Khatry & Basnyat Canada Pvt.Ltd</a></li>

                                </ul>
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="widget widget-newsletter">
                        <h4 class="widget-title">Subscribe newsletter</h4>
                        <p>Get all the latest information on Events,Sales and Offers. Sign up for newsletter today</p>
                        <form action="#">
                            <input type="email" class="form-control" placeholder="Email address" required>

                            <input type="submit" class="btn" value="Subscribe">
                        </form>
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <p class="footer-copyright">KhatryOnline.com. &copy;  {{date('Y')}}.  All Rights Reserved</p>
            <img src="/assets/images/payments.png" alt="payment methods" class="footer-payments">

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .footer-bottom -->
    </div><!-- End .containr -->
</footer><!-- End .footer -->