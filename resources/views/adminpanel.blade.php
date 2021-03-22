@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to the Ckecklists Service admin panel </div>
                <div class="card-body">
                  @foreach ($roles as $role)
                    You are {{ $role }}.
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
