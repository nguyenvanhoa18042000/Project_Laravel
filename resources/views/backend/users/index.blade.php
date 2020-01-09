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
  <div class="card">
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên người dùng</th>
          <!-- <th>Ảnh đại diện</th> -->
          <th>Trạng thái</th>
          <th>Vai trò</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
       @if(isset($users))
       @foreach($users as $user)
       <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>
          @if($user->role==2)
          <span href="" class="btn btn_active btn-sm"><i class="fas fa-toggle-on"></i></span>
          @elseif($user->status==1)
          <a href="{{ route('backend.user.edit_status',$user->id) }}" class="btn btn_active btn-sm" data-toggle="tooltip" title="Tắt hoạt động"><i class="fas fa-toggle-on"></i></a>
          @else 
          <a href="{{ route('backend.user.edit_status',$user->id) }}" class="btn btn_inactive btn-sm" data-toggle="tooltip" title="Bật hoạt động"><i class="fas fa-toggle-off"></i></a>
          @endif
        </td>
        <td>
          @if($user->role == 2)
          Quản trị viên
          @elseif ($user->role == 1)
          Nhân viên
          @else
          Khách hàng
          @endif
        </td>
        <td>
         <a href="{{ route('backend.user.show',$user->id) }}" class="btn btn-primary btn-sm js_user_item" data-toggle="tooltip" data-id={{$user->id}} title="Xem chi tiết" style="margin-right: 5%"><i class="fas fa-eye"></i></a>
         @if($user->role==1 || $user->role==2)
         <a href="{{ route('backend.user.show_products',$user->id) }}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Các sản phẩm đã đăng" style="margin-right: 5%"><i class="fas fa-list"></i></a>
         @endif
         @if($user->trashed() && $user->role!=2)
         <a href="{{ route('backend.user.open_or_block',$user->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Mở khóa tài khoản"><i class="fas fa-unlock-alt"></i></a>
         @elseif($user->role!=2)
         <a href="{{ route('backend.user.open_or_block',$user->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Khóa tài khoản"><i class="fa fa-lock" aria-hidden="true"></i></a>
         @endif
         @if($user->role!=2)
         <a href="{{ route('backend.user.destroy',$user->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa tài khoản"><i class="fa fa-trash" aria-hidden="true"></i></a>
         @endif
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