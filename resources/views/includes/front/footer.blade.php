{{-- order track  --}}
<div class="modal fade" id="orderTrack">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-5">
        <h2 class="mb-4 text-center">Track Order</h2>
        <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
          <div class="form-group">
            <label for="orderID">{{$lng->OrderId}} *</label>     
            <input type="text" class="form-control" placeholder="Order Id" id="orderID">
          </div>
          <div class="form-group mb-0">
            <button id="order-track-submit" type="button" class="default-btn mt-4 px-4">Submit</button>
          </div>
      </div>
    </div>
  </div>
</div>

{{-- login form  --}}
<div class="modal fade" id="login-modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"> 
     <div class="modal-body p-5">
        <h2 class="mb-4 text-center">{{$lng->LoginNow}}</h2>
        <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
          <div class="form-group">
            <label for="modal-email">{{$lng->Email}} *</label>     
            <input type="text" class="form-control" placeholder="Email" id="modal-email"> 
          </div>
          <div class="form-group">
            <label for="modal-password">{{$lng->Password}} *</label>     
            <input type="password" class="form-control" placeholder="Password" id="modal-password">
          </div>
          <div class="form-group mb-0">
            <button id="modal-login-button" type="button" class="default-btn mt-4 px-4">{{$lng->Login}}</button>
          </div>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row text-center text-sm-left">
                <div class="col-lg-3 col-sm-6 col-12 mt-5 mt-sm-0 ">
                <h4>{{$lng->Contact}}</h4>
                    <div class="contact-info"> 
                    <span>{{$setting->address}}</span>
                    <span>{{$setting->contact}}</span>
                        <span>{{$setting->mail}}</span>
                    </div>
                    <div class="mt-lg-3 social-links">
                      @if($setting->facebook_link)
                      <a aria-label="facebook" rel="noreferrer" href="{{$setting->facebook_link}}" target="_blank" class="facebook"><i class="ri-facebook-box-fill"></i></a>
                      @endif
                      @if($setting->skype_link)
                      <a aria-label="twitter" rel="noreferrer" href="{{$setting->skype_link}}" target="_blank" class="twitter"><i class="ri-twitter-fill"></i></a>
                      @endif
                      @if($setting->instagram_link)
                      <a aria-label="instagram" rel="noreferrer" href="{{$setting->instagram_link}}" target="_blank" class="instagram"><i class="ri-instagram-fill"></i></a>
                      @endif
                      @if($setting->pinterest_link)
                      <a aria-label="pinterest" rel="noreferrer" href="{{$setting->pinterest_link}}" target="_blank" class="google-plus"><i class="ri-pinterest-fill"></i></a>
                      @endif
                      @if($setting->youtube_link)
                      <a aria-label="youtube" rel="noreferrer" href="{{$setting->youtube_link}}" target="_blank" class="linkedin"><i class="ri-youtube-fill"></i></a>
                      @endif
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 footer-links mt-5 mt-sm-0 mt-lg-0 ">
                <h4>{{$lng->Information}}</h4>
                    <ul>
                        <li><a href="{{URL::to('/blog')}}">{{$lng->Blog}}</a></li>
                        <li><a href="{{URL::to('/faq')}}">{{$lng->FAQ}}</a></li>
                        <li><a href="{{URL::to('/about-us')}}">{{$lng->AboutUs}}</a></li>
                        <li><a href="{{URL::to('/contact')}}">{{$lng->ContactUs}}</a></li>
                        <li><a href="{{URL::to('/terms-condition')}}">{{$lng->TermsAndCondition}}</a></li>
                        @foreach($showPages as $page)
                        <li><a href="{{URL::to('/page/'.$page->slug)}}">{{$page->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 footer-links mt-5 mt-sm-3 mt-md-0 mt-lg-0 pt-sm-4 pt-lg-0">
                    <h4>{{$lng->Account}} </h4>
                    <ul>
                        <li><a href="{{route('user.home')}}">{{$lng->MyProfile}}</a></li>
                        <li><a href="{{route('user.wishlist')}}">{{$lng->MyWishList}}</a></li> 
                        <li><a href="{{route('user.order')}}">{{$lng->MyOrder}}</a></li>
                        <li><a href="{{route('user.affiliation')}}">{{$lng->Affiliation}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5 mt-sm-3 mt-md-0 mt-lg-0 pt-sm-4 pt-lg-0">
                    @if($setting->is_newsletter)
                    <h4>{{$lng->SignUpNewsleter}} </h4>
                    <div class="my-4 newsletter-form">
                        <input id="subscribe_email" type="text" class="form-control" placeholder="Your email address">
                    <button id="subscribe-btn" class="subscribe-btn">{{$lng->Subscribe}}</button>  
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
       <div class="container">
       <div class="row">       
           <div class="col-sm-6 col-12 text-center text-sm-left">
            <div class="copyright"> 
            <p class="mb-0">
                @if($setting->copyright_text)
                &copy; {{$setting->copyright_text}}
                @endif
            </p>
            </div>
           </div>
           <div class="col-sm-6 col-12 text-center text-sm-left text-lg-right mt-4 mt-sm-0">
            <div class="footer-logo">
                <div class="payment-method">                                        
                    <img  src="{{asset('images/banner/'.$setting->payment_image)}}">
              </div> 
            </div>           
           </div>
       </div>
       </div>
    </div>
</footer>
<div class="body-overlay"></div>
@if($setting->is_cookie)
@include('cookieConsent::index')
@endif