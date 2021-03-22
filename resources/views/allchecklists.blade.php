@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Checklists card -->
            <div class="card mt-3">
                <div class="card-header">
                    All checklists
                </div>
                @if(count($checklists) != 0)
                <div class="card-body">
                  <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title Checklist</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($checklists as $checklist)
                      <tr>
                        <td><a href="{{route('userTasks', $checklist->id)}}">{{ $checklist->title }}</a></td>
                        <td>{{ App\User::find($checklist->user_id)->name }}</td>
                        <td>{{  App\User::find($checklist->user_id)->email }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <div class="m-3">
                    <p>Here will be all checklists</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
