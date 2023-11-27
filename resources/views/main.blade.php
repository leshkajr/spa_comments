@extends('layouts.master')
@section('header')
    @include('layouts.header')
@stop
@section('content')
    <div class="main">
        <div>
            <div class="list-comments">
                @foreach($comments as $comment)
                    <div class="comment" style="margin-left: calc(50px * {{ $comment->numberInCascade }});
                     @if($comment->isMain === 0) margin-bottom: 35px; @endif">
                        <input type="hidden" id="idMainComment{{ $comment->id }}"
                               value="@if($comment->idMainComment === null) -1 @else {{ $comment->idMainComment }} @endif"/>
                        <div class="d-flex flex-row align-items-center comment-title-container">
                            <div class="img-ava">
                                <img src="https://img.freepik.com/premium-vector/purple-circle-with-white-person-icon_876006-6.jpg"/>
                            </div>
                            <div class="title-name">
                                @if($comment->homepage !== '')
                                    <a class="a" href="{{ $comment->homepage }}" target="_blank">
                                        {{ $comment->username }}
                                    </a>
                                @else
                                    {{ $comment->username }}
                                @endif
                            </div>
                            <div class="title-timestamp">{{ $comment->created_at }}</div>
                            <div class="title-review-button"
                                 onclick="clickReview({{ $comment->id }},'{{ $comment->username }}', `{!! $comment->comment !!}`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
                                </svg>
                            </div>
                        </div>
                        @if($comment->isMain === 0)
                            <div class="sm-v-review-comment d-flex flex-row align-items-center">
                                <div class="review-hr"></div>
                                <div class="text">
                                    {!! str_replace(PHP_EOL,' ',substr($comment->reviewComment->comment,0,50)) !!}
                                </div>
                            </div>
                        @endif
                        @if($comment->pathImage !== null)
                            <div>
                                <div id="imagePreview{{ $comment->id }}" class="imagePreview">
                                </div>
                                <script type="text/javascript"> previewImage('imagePreview{{ $comment->id }}','{{ asset($comment->pathImage) }}')</script>
                            </div>
                        @endif
                        <div class="text-comment">{!! $comment->comment !!}</div>
                    </div>
                @endforeach
            </div>

            <div>
                <nav aria-label="Page navigation" class="d-flex justify-content-center" style="margin-bottom: 30px;">
                    <ul class="pagination">
                        @for($i = 1; $i <= $countPages; $i++)
                            <li class="page-item"><a class="page-link" href="{{ route('main-comments',$i) }}">{{ $i }}</a></li>
                        @endfor
                    </ul>
                </nav>
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
    <script src="{{ URL::asset('js/reviewComment.js')}}"></script>
@stop
