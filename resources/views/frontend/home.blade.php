@extends('frontend.layouts.master')
@section('title')
Trang chủ
@endsection
@section('css')
@endsection
@section('script')
@endsection
@section('content-header')
@endsection

@section('content')
<div class="box-home" style="margin-bottom: 2%;">
<div class="container" style="margin-top: 1%;">
    <div class="row">
        <div class="col-8" style=" padding-left: 0;height: 239px;"><img style="width: 100%;height: 239px;" src="https://cdn.tgdd.vn/2020/02/banner/800x300-800x300.jpg"></div>
        <div class="col-4" style="padding-left: 0;height: 239px;">
            <img style="margin-bottom: 4%;width: 100%;height: 48%" src="https://cdn.tgdd.vn/2020/02/banner/A01-398-110-398x110-3.png">
            <img style="width: 100%;height: 44%;" src="https://cdn.tgdd.vn/2020/02/banner/iphone-7plus-398-110-398x110-2.png">
        </div>
    </div>
</div>
@foreach($categories as $category)
@if($category->hot == App\Models\Category::HOT)
<div class="container" style="margin-top: 1%;">
    <div class="row">
        <div class="navigat cate42">
            <h2>{{$category->name}} nổi bật nhất</h2>
            <div class="viewallcat">
                @foreach($category->trademarks as $trademark)
                <a href="{{route('frontend.detail_category',['slug' => $category->slug,'trademark' => $trademark->slug])}}"><span style="text-transform: capitalize;">{{$trademark->name}}</span></a>
                @endforeach
                <a href="{{route('frontend.detail_category',$category->slug)}}" class="mobile">Xem tất cả <span style="text-transform: lowercase;">{{$category->name}}</span></a>
            </div>
        </div>
        <ul class="homeproduct" style="border-left:1px solid #eee ">
            @foreach($category->products->take(10) as $product)
            <li class="product" data-id="210441" style="padding-bottom: 20px;padding-top: 5px;">
                <a href="{{route('frontend.detail_product',$product->slug)}}" >
                    <img width="180" height="180" src="{{asset($product->image)}}" />
                    <h3 class="name_product" style="margin-bottom: 0">{{$product->name}}</h3>
                    <div class="price" style="padding-bottom: 5px;">
                        @php 
                        $price_sale = $product->sale_price - ($product->sale_price * (($product->discount_percent)/100))
                        @endphp
                        <strong>
                            {{number_format($price_sale,0,",","."
                            )}}₫
                        </strong>
                        @if($product->discount_percent > 0)
                        <span style="font: 14px/18px Helvetica,Arial,'DejaVu Sans','Liberation Sans',Freesans,sans-serif;font-size: 13px;">{{$product->sale_price}}₫</span>
                        @endif
                    </div>
                    <div class="ratingresult" style="padding: 0 10px;">
                        <?php
                        $star = 0;
                        if ($product->total_rating) {
                          $star = round($product->total_number_star / $product->total_rating,1);
                      }
                      ?>
                      @for($i=1;$i<=5;$i++)
                      <i class="fa fa-star" style="color:{{ $i <= $star ? '#ff9705' : '#898989'}};"></i>
                      @endfor
                      <!-- </span> -->
                      <span style="text-decoration: none;">{{$product->total_rating}} đánh giá</span>
                  </div>
                  @if($product->amount != 0)
                  @if($product->discount_percent > 0)
                  <label class="discount">GIẢM {{number_format($product->sale_price - $price_sale,0,",",".")}}₫</label>
                  @else
                  <label class="installment">Trả góp 0%</label>
                  @endif
                  @else
                  <label style="background: #22bddb" class="installment">Đang nhập hàng</label> 
                  @endif
                  <a href="{{route('frontend.add.cart',$product->id)}}" class="btn btn-store">MUA NGAY</a>       
              </a>
          </li>
          @endforeach
      </ul>
    </div>
</div>
@endif
@endforeach
</div>
@endsection
