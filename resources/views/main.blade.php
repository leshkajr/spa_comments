@extends('layouts.master')
@section('header')
    @include('layouts.header')
@stop
@section('content')
    <div class="main">
        <div>
            <div class="list-comments">
                <div class="comment">
                    <div class="d-flex flex-row align-items-center
                     comment-title-container">
                        <div class="img-ava">
                            <img src="https://img.freepik.com/premium-vector/purple-circle-with-white-person-icon_876006-6.jpg"/>
                        </div>
                        <div class="title-name">
                            Anonym
                        </div>
                        <div class="title-timestamp">22.05.22 в 23:23</div>
                        <div class="title-review-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-comment">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut blandit convallis tempus. Curabitur ut velit id odio malesuada consequat id in lacus. Donec vestibulum, sapien nec suscipit vestibulum, turpis urna posuere ipsum, sit amet sagittis lacus sem sed felis. Etiam at finibus odio, sed pellentesque leo. Vestibulum luctus facilisis quam et commodo. Sed vestibulum at lorem id fermentum. Nam dictum sit amet mi rutrum lobortis. Sed at purus feugiat, finibus diam eget, eleifend sapien.

Phasellus semper vel nibh non tincidunt. Curabitur interdum, nibh mattis tincidunt blandit, ex nunc consectetur nulla, eu placerat leo velit quis orci. In dapibus justo a sapien ullamcorper tristique. Morbi sed dictum augue, a varius sem. Donec at tincidunt quam. Cras pulvinar, sapien laoreet lobortis aliquam, quam nibh pharetra urna, ultrices pulvinar elit justo sed felis. Donec eu mi ullamcorper, dapibus metus a, bibendum libero.</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('layouts.footer-message')
@stop

@section('scripts')
    <script src="{{ URL::asset('js/checkFile.js')}}"></script>
    <script src="{{ URL::asset('js/animation.js')}}"></script>
    <script src="{{ URL::asset('js/textareaCommentEvents.js')}}"></script>
@stop
