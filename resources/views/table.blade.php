@extends('layouts.master')
@section('header')
    @include('layouts.header')
@stop
@section('content')
    <div class="main">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col" onclick="sortCommentBy('username');" style="cursor:pointer;">Username</th>
                        <th scope="col" onclick="sortCommentBy('email');" style="cursor:pointer;">Email</th>
                        <th scope="col">Page Home</th>
                        <th scope="col">Comment</th>
                        <th scope="col" onclick="sortCommentBy('created_at');" style="cursor:pointer;">Create time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <th scope="row">{{ $comment->id }}</th>
                            <td>{{ $comment->username }}</td>
                            <td>{{ $comment->email }}</td>
                            <td><a href="{{ $comment->homepage }}" target="_blank">{{ $comment->homepage }}</a></td>
                            <td>{!! $comment->comment !!}</td>
                            <td>{{ $comment->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer')
@stop

@section('scripts')
    <script src="{{ asset('js/sortCommentBy.js') }}"></script>
@stop
