<header>
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Setting Area -->
                            @if(Auth::user())
                            <li style="width: 29%">
                                <div class="ht-setting-trigger" style="font-size: 15px;width: 100%">
                                    <div style="text-align: right;">
                                        <img src="{{asset(Auth::user()->avatar)}}" style="width: 30px;height: 30px;border-radius: 50%;margin-right: 6%"><span>{{Auth::user()->name}}</span>
                                    </div>
                                </div>
                                <div class="setting ht-setting">
                                    <ul class="ht-setting-list">
                                        @if(Auth::user()->role == 2 || Auth::user()->role == 1)
                                        <li><a href="{{route('backend.home')}}" style="color: black">Trang hệ thống</a></li>
                                        @else
                                        <li><a href="{{route('profile.index')}}" style="color: black">Trang cá nhân</a></li>
                                        @endif
                                        <li>
                                            <a href="{{ route('logout') }}" style="color: black"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                Đăng xuất
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @else
                            <li>
                                <div style="font-size: 15px;"><a class="link-button" href="{{route('login')}}">Đăng nhập</a></div>
                            </li>
                            <li>
                                <div class="" style="font-size: 15px;"><a  href="{{route('register')}}">Đăng ký</a></div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="index.html">
                            <!-- <img src="{{asset('frontend/images/menu/logo/1.jpg')}}" alt=""> -->
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="#" class="hm-searchbox">
                        <select class="nice-select select-search-category">
                            <option value="0">All</option>                         
                            <option value="10">Laptops</option>                     
                            <option value="17">- -  Prime Video</option>                    
                            <option value="20">- - - -  All Videos</option>                     
                            <option value="21">- - - -  Blouses</option>                        
                            <option value="22">- - - -  Evening Dresses</option>                
                            <option value="23">- - - -  Summer Dresses</option>                     
                            <option value="24">- - - -  T-shirts</option>                       
                            <option value="25">- - - -  Rent or Buy</option>                        
                            <option value="26">- - - -  Your Watchlist</option>                     
                            <option value="27">- - - -  Watch Anywhere</option>                     
                            <option value="28">- - - -  Getting Started</option>         
                            <option value="18">- - - -  Computers</option>                      
                            <option value="29">- - - -  More to Explore</option>         
                            <option value="30">- - - -  TV &amp; Video</option>                     
                            <option value="31">- - - -  Audio &amp; Theater</option>               
                            <option value="32">- - - -  Camera, Photo </option>
                            <option value="33">- - - -  Cell Phones</option>                        
                            <option value="34">- - - -  Headphones</option>                     
                            <option value="35">- - - -  Video Games</option>                        
                            <option value="36">- - - -  Wireless Speakers</option>            
                            <option value="19">- - - -  Electronics</option>                        
                            <option value="37">- - - -  Amazon Home</option>                        
                            <option value="38">- - - -  Kitchen &amp; Dining</option>           
                            <option value="39">- - - -  Furniture</option>                      
                            <option value="40">- - - -  Bed &amp; Bath</option>                     
                            <option value="41">- - - -  Appliances</option>                 
                            <option value="11">TV &amp; Audio</option>                  
                            <option value="42">- -  Chamcham</option>                        
                            <option value="45">- - - -  Office</option>                     
                            <option value="47">- - - -  Gaming</option>                 
                            <option value="48">- - - -  Chromebook</option>                     
                            <option value="49">- - - -  Refurbished</option>                    
                            <option value="50">- - - -  Touchscreen</option>                        
                            <option value="51">- - - -  Ultrabooks</option>                     
                            <option value="52">- - - -  Blouses</option>                        
                            <option value="43">- -  Meito</option>                        
                            <option value="53">- - - -  Hard Drives</option>                        
                            <option value="54">- - - -  Graphic Cards</option>                      
                            <option value="55">- - - -  Processors (CPU)</option>  
                            <option value="56">- - - -  Memory</option>                     
                            <option value="57">- - - -  Motherboards</option>                       
                            <option value="58">- - - -  Fans &amp; Cooling</option> 
                            <option value="59">- - - -  CD/DVD Drives</option>                      
                            <option value="44">- -  Sony Bravia</option>                        
                            <option value="60">- - - -  Sound Cards</option>                        
                            <option value="61">- - - -  Cases &amp; Towers</option>   
                            <option value="62">- - - -  Casual Dresses</option>                     
                            <option value="63">- - - -  Evening Dresses</option>       
                            <option value="64">- - - -  T-shirts</option>                       
                            <option value="65">- - - -  Tops</option>                                 
                            <option value="12">Smartphone</option>                  
                            <option value="66">- -  Camera Accessories</option>                     
                            <option value="68">- - - -  Octa Core</option>                      
                            <option value="69">- - - -  Quad Core</option>                  
                            <option value="70">- - - -  Dual Core</option>                      
                            <option value="71">- - - -  7.0 Screen</option>                     
                            <option value="72">- - - -  9.0 Screen</option>                     
                            <option value="73">- - - -  Bags &amp; Cases</option>                   
                            <option value="67">- -  XailStation</option>                     
                            <option value="74">- - - -  Batteries</option>                      
                            <option value="75">- - - -  Microphones</option>                        
                            <option value="76">- - - -  Stabilizers</option>                        
                            <option value="77">- - - -  Video Tapes</option>                        
                            <option value="78">- - - -  Memory Card Readers</option> 
                            <option value="79">- - - -  Tripods</option>           
                            <option value="13">Cameras</option>                          
                            <option value="14">headphone</option>                                
                            <option value="15">Smartwatch</option>                           
                            <option value="16">Accessories</option>
                        </select>
                        <input type="text" placeholder="Enter your search key ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
  <!--                           <li class="hm-wishlist">
                                <a href="wishlist.html">
                                    <span class="cart-item-count wishlist-item-count">0</span>
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </li> -->
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    <span class="item-text">
                                        <span class="cart-item-count" style="top: -12px;left: -65px;">{{\Cart::count()}}</span>
                                    </span>
                                </div>
                                <span></span>
                                @if((\Cart::count()) > 0)
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        @foreach((\Cart::content()) as $product)
                                        <li>
                                            <a href="{{route('frontend.detail_product',['category_id' => $product->options->category_id, 'slug' => $product->options->slug])}}" class="minicart-product-image">
                                                <img src="{{asset($product->options->image)}}" alt="cart products">
                                            </a>
                                            <div class="minicart-product-details">
                                                <h6><a href="{{route('frontend.detail_product',['category_id' => $product->options->category_id, 'slug' => $product->options->slug])}}">{{$product->name}}</a></h6>
                                                <span>{{number_format($product->price)}}₫ x {{$product->qty}}</span>
                                            </div>
                                            <button class="close">
                                                <a href="{{route('frontend.destroy.cart',$product->rowId)}}">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </button>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <p class="minicart-total">Tổng tiền: <span style="color: #e80f0f">{{\Cart::subtotal()}}₫</span></p>
                                    <div class="minicart-button">
                                        <a href="{{route('frontend.list.cart')}}" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                            <span>Giỏ hàng</span>
                                        </a>
                                        <a href="{{route('frontend.get.form.pay')}}" class="li-button li-button-fullwidth li-button-sm">
                                            <span>Thanh toán</span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
        <header id="#menu" style="background: #fed700">
        <div class="wrap-main /dtdd/iphone-11-pro-max">
            <a class="logo " title="Về trang chủ Thegioididong.com" href="/" aria-label="logo">
                <img width="170px" class="icon-logo" src="http://mauweb.monamedia.net/thegioididong/wp-content/uploads/2018/01/logo-mona-dmx-tgdd-white.png">
            </a>
            <form id="search-site" action="/tim-kiem" method="get" autocomplete="off">
                <input class="topinput" id="search-keyword" name="key" type="text" aria-label="Bạn tìm gì..." placeholder="Bạn tìm gì..." autocomplete="off" onkeyup="SuggestSearch(event,this, 0);" maxlength="50" />
                <button class="btntop" type="submit" aria-label="tìm kiếm"><i class="icontgdd-topsearch"></i></button>
            </form>
            <nav style="height: 100%;">
                @foreach($categories as $category)
                    @if($category->parent_id == NULL && $category->deleted_at == NULL)

                    <a href="{{route('frontend.detail_category',$category->slug)}}" style="vertical-align: middle;" class="mobile" >
                        @if($category->image != null)
                        <img style="background-position: -190px 0;width: 25px;height: 25px;display: block;margin: 2px auto 3px;" src="{{asset($category->image)}}">
                        @endif
                        {{$category->name}}
                    </a>
                    @endif
                @endforeach
                <a href="{{route('frontend.news')}}" class="news" title="Tin công nghệ" style="vertical-align: middle;">
                    <img style="background-position: -190px 0;width: 25px;height: 25px;display: block;margin: 2px auto 3px;" src="http://mauweb.monamedia.net/thegioididong/wp-content/uploads/2017/12/folded-newspaper-1.png">
                    Tin công nghệ
                </a>
                <a href="{{route('frontend.contact.create')}}" class="" title="Hỏi đáp" style="vertical-align: middle;">
                    <img style="background-position: -190px 0;width: 25px;height: 25px;display: block;margin: 2px auto 3px;" src="http://mauweb.monamedia.net/thegioididong/wp-content/uploads/2017/12/discuss-issue-1.png">
                    Hỏi đáp
                </a>
            </nav>
            <div id="gifjumping" class="gifjumping" style="display:none;">
                <div class="gifjumping__Container">
                    <a href="javascript:void(0)" onclick="$('#gifjumping').hide(); setlocalStorage('valentinemwg', 1);" id="btnCloseGif"><img style="max-width:80%;" src="/Content/desktop/images/VLT_GIF_DESK_Closed.png"></a>
                    <a href="/khuyen-mai-soc/dong-ho-gia-soc?itm_source=popup-trang-dong-ho"> <img src="/Content/desktop/images/VLT_GIF_DESK.gif" class="giftungtang"> </a>
                    
                </div>
            </div>
        </div>
        <div class="clr"></div>
    </header>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container"> 
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>