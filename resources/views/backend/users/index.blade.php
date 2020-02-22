@extends('backend.layouts.master')
@section('title')
Danh sách người dùng
@endsection
@section('css')
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

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
      <h1 class="m-0 text-dark">Quản lí người dùng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        <li class="breadcrumb-item active">Quản lí người dùng</li>
        <li class="breadcrumb-item active">Danh sách</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>
@endsection
@section('content')

<section class="content">

  <!-- Default box -->
  <h3 style="text-align: center;">-- Danh sách người dùng --</h3>
  @can('create',App\Models\User::class)
    <a href="{{route('backend.user.create')}}" class="btn btn-sm btn-success" style="color: white; float: right;margin:0 1% 1% 0;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới người dùng</a>
  @endcan
  <div class="card">
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th>ID</th>
          <th>Tên người dùng</th>
          <!-- <th>Ảnh đại diện</th> -->
          <th>Trạng thái</th>
          <th>Quyền</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
       @if(isset($users))
       @foreach($users as $user)
       <tr>
        <td>{{ $user->id }}</td>
        <td><img width="40px" height="40px" style="border-radius: 50%; margin-right: 1%" src="{{asset($user->avatar)}}"> {{ $user->name }}</td>
        <td>
          @can('isAdmin',App\Models\User::class)
            @if($user->role == 2)
              <span style="cursor: context-menu;" class="btn btn_active btn-sm"><i class="fas fa-toggle-on"></i></span>
            @elseif($user->status == 1 && $user->role != 2)
              <a href="{{ route('backend.user.edit_status',$user->id) }}" class="btn btn_active btn-sm" data-toggle="tooltip" title="Tắt hoạt động"><i class="fas fa-toggle-on"></i></a>
            @else 
              <a href="{{ route('backend.user.edit_status',$user->id) }}" class="btn btn_inactive btn-sm" data-toggle="tooltip" title="Bật hoạt động"><i class="fas fa-toggle-off"></i></a>
            @endif
          @endcan

          @can('isQTV',App\Models\User::class)
            @if($user->status == 1)
              <span style="cursor: context-menu;" class="btn btn_active btn-sm"><i class="fas fa-toggle-on"></i></span>
            @else
              <span style="cursor: context-menu;" class="btn btn_inactive btn-sm"><i class="fas fa-toggle-off"></i></span>
            @endif
          @endcan
        </td>
        <td>
          @if($user->role == 2)
          Quản lý
          @elseif ($user->role == 1)
          Quản trị viên
          @else
          Khách hàng
          @endif
        </td>
        <td>
        @can('viewAny',App\Models\User::class)
         <a href="{{ route('backend.user.show',$user->id) }}" class="btn btn-primary btn-sm js_user_item" data-toggle="tooltip" data-id="{{$user->id}}" title="Xem chi tiết" style="margin-right: 5%"><i class="fas fa-eye"></i></a>
        @endcan


        @can('isAdmin',App\Models\User::class)
         @if($user->trashed() && $user->role!=2)
         <a href="{{ route('backend.user.open_or_block',$user->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Mở khóa tài khoản"><i class="fa fa-lock"></i></a>

         <a href="{{ route('backend.user.forcedelete',$user->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a>
         @elseif($user->role!=2)
         <a href="{{ route('backend.user.open_or_block',$user->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Khóa tài khoản"><i class="fas fa-unlock-alt"></i></a>
         @endif
        @endcan
       </td>
     </tr>
     @endforeach
     @endif
   </tbody>
 </table>
 <div style="float: right; margin-right: 3%; margin-top: 2%;">{!! $users->links() !!}</div>

</div>
<!-- /.card-body -->
<!-- <div class="card-footer">Danh sách danh mục</div> -->

</div>
</div>
<!-- /.card -->

</section>
@endsection