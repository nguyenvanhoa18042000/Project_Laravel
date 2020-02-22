@extends('backend.layouts.master')
@section('title')
Chi tiết người dùng
@endsection
@section('css')
<style type="text/css">
  tr>td:first-child{
    font-weight: 600;
    /*color: white;
    background-color: #6c7ae0;*/
  }
</style>
@endsection
@section('script')
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
        <li class="breadcrumb-item active">Chi tiết</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>
@endsection
@section('content')
<section class="content">

  <!-- Default box -->
  <!-- <h3 style="text-align: center;">-- Chi tiết người dùng --</h3> -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Thông tin người dùng : {{$user->name}}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered">
      <tbody>
        <tr>
          <td width="50%">Tên người dùng</td>
          <td width="50%"><img style="width:50px;height: 50px; border-radius: 50%;margin-right: 1%;" src='{{asset($user->avatar)}}'>{{$user->name}}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>{{$user->email}}</td>
        </tr>
        <tr>
          <td>Trạng thái hoạt động</td>
          <td>
            @if($user->status == 1 && $user->deleted_at == NULL)
            Hoạt động
            @elseif($user->status == 0 && $user->deleted_at == NULL)
            Tắt hoạt động
            @else
            Khóa đăng nhập
            @endif
          </td>
        </tr>
        <tr>
          <td>Quyền</td>
          <td>
            @if($user->role == 2)
            Quản lý
            @elseif($user->role == 1)
            Quản trị viên
            @else
            Khách hàng
            @endif
          </td>
        </tr>
        <tr>
          <td>Số điện thoại</td>
          <td>
            @if($user->phone !=NULL)
            {{$user->phone}}
            @else
            Trống
            @endif
          </td>
        </tr>
        <tr>
          <td>Địa chỉ</td>
          <td>
            @if($user->address !=NULL)
            {{$user->address}}
            @else
            Trống
            @endif
          </td>
        </tr>
        <tr>
          <td>Thời gian đăng kí</td>
          <td>
            {{ $user->created_at->format('H:i:s - d/m/Y') }}
          </td>
        </tr>
        <tr>
          <td>Lần cập nhật gần nhất</td>
          <td>
            {{ $user->updated_at->format('H:i:s - d/m/Y') }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
  
</section>
@endsection