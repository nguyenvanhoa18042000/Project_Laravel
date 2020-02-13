<?php Carbon\Carbon::setLocale('vi'); ?>
@extends('backend.layouts.master')
@section('title')
Danh sách liên lạc
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
      <h1 class="m-0 text-dark">Quản lí liên lạc</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        <li class="breadcrumb-item active">Quản lí liên lạc</li>
        <li class="breadcrumb-item active">Liên hệ</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>
@endsection
@section('content')

<section class="content">
  <h3 style="text-align: center;">-- Danh sách liên hệ --</h3>
  <div class="card">
  </div>
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th>ID</th>
          <th>Chủ đề</th>
          <th>Tiêu đề</th>
          <th>Email</th>                     
          <th>Số điện thoại</th>
          <th>Thời gian</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($contacts))
        @foreach($contacts as $contact)
        <tr>
          <td>{{ $contact->id }}</td>

          <td>
            {{ isset($contact->topic->name) ? $contact->topic->name :'' }}
          </td>

          <td>
            {{ (Str::limit($contact->title, 80, $end='...')) }}
          </td>

          <td>{{ (Str::limit($contact->email, 80, $end='...')) }}</td>
          <td>{{ $contact->phone }}</td>
          <td>{{ $contact->created_at->diffForHumans() }}</td>

          <td>
          @if($contact->status == 1)
            <span class="badge badge-success">Đã trả lời</span>
          @else
            <span class="badge badge-secondary">Chưa trả lời</span>
          @endif  
          </td>

          <td>
            @can('delete',$contact)
              <a href="{{ route('backend.contact.destroy',$contact->id) }}" class="btn btn_delete btn-sm " data-toggle="tooltip" title="Xóa" style="margin-right: 1%"><i class="fa fa-times"></i></a>
            @endcan
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div style="float: right; margin-right: 2%">{!! $contacts->links() !!}</div>
  </div>
  <!-- /.card-body -->
  <!-- <div class="card-footer">Danh sách danh mục</div> -->

</div>
</div>
<!-- /.card -->

</section>
@endsection
