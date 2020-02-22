@extends('backend.profiles.layout')
@section('title')
Danh sách đánh giá
@endsection
@section('script')
<script>
  @if(Session::has('message'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "timeOut": "3000",
  }
  var type="{{Session::get('alert-type')}}"
  switch(type){
    case 'success':
    toastr.success("{{ Session::get('message') }}");
    break;
    case 'error':
    toastr.error("{{ Session::get('message') }}");
    break;
  }
  @endif
</script>
@endsection
@section('content-header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Trang chủ</h1>
		</div>
    <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đánh giá của bạn</li>
            </ol>
        </div>
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
                      <th style="width: 5%">STT</th>
                      <th style="width: 25%">Sản phẩm</th>
                      <th style="width: 33%">Nội dung</th>
                      <th style="width: 15%">Điểm đánh giá</th>
                      <th style="width: 12%">Thời gian</th>
                      <th style="width: 10%">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($ratings))
                      @foreach($ratings as $key => $rating)
                        @if($rating->product->deleted_at == NULL)
                        <tr>
                          <td>
                            {{ $key + 1 }}
                          </td>
                          <td>
                            <a class="to-link" style="color: ##007bff;" target="_blank" href="{{route('frontend.detail_product',$rating->product->slug)}}">
                              {{ isset($rating->product->name) ? (Str::limit($rating->product->name, 100, $end='...')) : '[N\A]' }}
                            </a>
                          </td>
                          <td style="max-width: 200px;overflow: auto;">{{ $rating->content }}</td>
                          <td>
                            @for($i=1;$i<=5;$i++)
                              <i class="fa fa-star" style="color:{{$i <= $rating->number_star ? '#ff9705' : ''}};"></i>
                            @endfor
                          </td>
                          <td>{{$rating->created_at->format('H:i:s | d/m/Y')}}</td>
                          <td>
                            <a href="{{ route('profile.user.rating.forcedelete',$rating->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                        @endif
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