
@extends('backend.layouts.master')
@section('title')
Danh sách đánh giá
@endsection
@section('script')
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
@section('content-header')

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản lí đánh giá</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí đánh giá</li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <h3 style="text-align: center;">-- Danh sách đánh giá --</h3>
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover" style="table-layout: fixed">
                  <thead class="add-background-thead">
                    <tr>
                      <th style="width: 15%">Tên người dùng</th>
                      <th style="width: 25%">Sản phẩm</th>
                      <th style="width: 35%">Nội dung</th>
                      <th style="width: 15%">Điểm đánh giá</th>
                      <th style="width: 10%">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($ratings))
	                  	@foreach($ratings as $rating)
		                    <tr>
		                      <td>
                            {{ isset($rating->user->name) ? $rating->user->name : '[N\A]' }}
                          </td>
		                      <td>
                            {{ isset($rating->product->name) ? $rating->product->name : '[N\A]' }}
                          </td>
                          <td style="max-width: 200px;overflow: auto;">{{ $rating->content }}</td>
                          <td>
                            @for($i=1;$i<=5;$i++)
                              <i class="fa fa-star" style="color:{{$i <= $rating->number_star ? '#ff9705' : ''}};"></i>
                            @endfor
                          </td>
		                      <td>
		                      	<a href="{{ route('backend.rating.forcedelete',$rating->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a>
		                      </td>
		                  	</tr>
		                @endforeach
	                @endif
                  </tbody>
                </table>
                <div style="float: right; margin-right: 2%">{!! $ratings->links() !!}</div>
              
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách danh mục</div> -->
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection