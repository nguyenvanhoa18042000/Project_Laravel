@extends('backend.layouts.master')
@section('title')
Danh sách chủ đề
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
                    <li class="breadcrumb-item active">Chủ đề</li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <h3 style="text-align: center;">-- Danh sách chủ đề --</h3>
      @can('create',App\Models\Topic::class)
        <a href="{{route('backend.topic.create')}}" class="btn btn-sm btn-success" style="color: white; float: right;margin:0 1% 1% 0;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới chủ đề liên lạc</a>
      @endcan
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover">
                  <thead class="add-background-thead">
                    <tr>
                      <th>ID</th>
                      <th>Tên chủ đề</th>
                      <th>Danh mục cha</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($topics))
	                  	@foreach($topics as $topic)
		                    <tr>
		                      <td>{{ $topic->id }}</td>
		                      <td>
                            {{ $topic->name }}
                          </td>
                          <td>
                            @if($topic->parent_id == NULL)
                              Danh mục cha
                            @else
                              @foreach($topics as $topic2nd)
                                @if($topic->parent_id == $topic2nd->id)
                                  {{$topic2nd->name}}
                                @else
                                @continue
                                @endif
                              @endforeach
                            @endif
                          </td>
		                      <td>
                            @can('update',$topic)
		                      	<a href="{{ route('backend.topic.edit',$topic->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa" style="margin-right: 1%"><i class="fas fa-edit"></i></a>
                            @endcan
                            
                            @can('delete',$topic)
                            <a href="{{ route('backend.topic.destroy',$topic->id) }}" class="btn btn_delete btn-sm " data-toggle="tooltip" title="Xóa" style="margin-right: 1%"><i class="fa fa-times"></i></a>
                            @endcan
		                      </td>
		                  	</tr>
		                @endforeach
	                @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách danh mục</div> -->
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection