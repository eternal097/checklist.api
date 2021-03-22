@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tasks card -->
                <div class="card mt-3">
                    <div class="card-header">
                        User tasks
                    </div>
                    @if(count($tasks) != 0)
                        <div class="card-body">
                            @foreach($tasks as $task)
                                <div class="row mt-1">
                                    <div class="col-1">
                                        @if($task->completed == 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <p class="lead">{{$task->message}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="m-3">
                            <p>Here will be user tasks</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
