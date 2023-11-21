<?php include($_SERVER['DOCUMENT_ROOT'].'/php/captcha.php') ?>
<div class="footer">
    <form action="{{ route("main-post") }}" method="POST" class="main-form-add-comment">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mb-2 fade show" role="alert">
                <ul style="list-style-type: none; margin-bottom: 0">
                    @foreach ($errors->all() as $error)
                        <li>
{{--                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>--}}
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div>
        <div class="d-flex flex-row">
            <div style="width: 85%;">
                <div class="mb-3 d-flex flex-row">
                    <div style="width: 32.3%">
                        <input type="text" name="username"
                               class="form-control @error('username') is-invalid @enderror"
                               id="username" aria-describedby="usernameHelp" placeholder="User Name"
                               required>
                        <div id="usernameHelp" class="form-text">Numbers and letters of the Latin alphabet.</div>
                    </div>
                    <div style="width: 32.3%; margin-left: 1.5%">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email" required
                               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div style="width: 32.3%; margin-left: 1.5%">
                        <input type="text"
                               class="form-control @error('urlHomePage') is-invalid @enderror" name="urlHomePage"
                               id="homepage" aria-describedby="homepageHelp" placeholder="Home page">
                        <div id="homepageHelp" class="form-text">Your own url.</div>
                    </div>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="file" id="attachmentFiles" name="attachmentFiles" style="color: var(--text-color);"
                    onchange="uploadFile();">
                </div>
                <div>
                    <div id="imagePreview" class="imagePreview"></div>
                </div>
                <div>
                    <textarea class="form-control @error('comment') is-invalid @enderror" style="height: 100px;" name="comment"
                              id="text" aria-describedby="homepageHelp" placeholder="Your comment"></textarea>
                </div>
            </div>
            <div class="d-flex flex-column comment-container-right-side">
                <div>
                    <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror"
                           required placeholder="Captcha" />
                    <div class="captcha-container">
                        {!! captcha_img() !!}
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center button-send">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--button-background-color)" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>