@extends('layouts.master')
@section('header')
    @include('layouts.header')
@stop
@section('content')
    <div class="main">
        <div>
            <div class="list-comments">
                @foreach($comments as $comment)
                    <div class="comment">
                        <div class="d-flex flex-row align-items-center comment-title-container">
                            <div class="img-ava">
                                <img src="https://img.freepik.com/premium-vector/purple-circle-with-white-person-icon_876006-6.jpg"/>
                            </div>
                            <div class="title-name">
                                {{ $comment->username }}
                            </div>
                            <div class="title-timestamp">{{ $comment->created_at }}</div>
                            <div class="title-review-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div id="imagePreview{{ $comment->id }}" class="imagePreview">
                            </div>
                            <script type="text/javascript"> previewImage('imagePreview{{ $comment->id }}','{{ asset($comment->pathImage) }}')</script>
                        </div>
                        <div class="text-comment">{!! $comment->comment !!}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('layouts.footer-message')
@stop

@section('scripts')

    <script src="{{ URL::asset('js/animation.js')}}"></script>
    <script src="{{ URL::asset('js/textareaCommentEvents.js')}}"></script>
    <script src="{{ URL::asset('js/sendComment.js')}}"></script>
    <script src="{{ URL::asset('js/inputChanges.js')}}"></script>
    <script src="{{ URL::asset('js/previewComment.js')}}"></script>
@stop
