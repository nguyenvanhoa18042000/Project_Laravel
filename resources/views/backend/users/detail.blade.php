@if($user)
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($user as $u)
    <tr>
      <th scope="row">$u->id</th>
      <td>$u->name</td>
      <td>$u->phone</td>
      <td>$u->address</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif