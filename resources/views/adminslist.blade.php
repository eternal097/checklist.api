@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admins list</div>
                <div class="card-body">
                  @if(count($admins) != 0)
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#id</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Permission to<br> manage checklists</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($admins as $admin)
                        <tr>
                          <td>{{ $admin->id }}</td>
                          <td>{{ $admin->name }}</td>
                          <td>{{ $admin->email }}</td>
                          <td>
                            <form action="{{route('permissionUpdate', $admin->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                                <input type="text" name="permission" value="manage checklists" hidden>
                                @if(App\User::find($admin->id)->hasPermissionTo('manage checklists'))
                                <button class="btn btn-danger btn-sm" type="submit">Deny</button>
                                @else
                                <button class="btn btn-success btn-sm" type="submit">Allow</button>
                                @endif
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  @else
                  <div class="m-3">
                      <p>Here will be admins...</p>
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
