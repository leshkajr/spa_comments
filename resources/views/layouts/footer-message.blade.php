{{--<?php include($_SERVER['DOCUMENT_ROOT'].'/php/captcha.php') ?>--}}
<div class="footer" id="footer">
    <div class="d-flex justify-content-end w-100">
        <div class="mb-1" style="margin-right: 70px; margin-top: 10px;">
            <button onclick="collapseFooter('form-footer');">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="container-show-review-comment" id="container-show-review-comment">
        <div class="title-review-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
            </svg>

            <button type="button" class="ms-3" onclick="deleteReview();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </button>
        </div>
        <div style="margin-left: 25px; margin-top: 5px;">
            <div id="review-comment-username" class="review-title-name"></div>
            <div id="review-comment-comment" class="review-title-comment"></div>
        </div>
    </div>
    <form action="{{ route("main-post") }}" method="POST" class="main-form-add-comment visible" id="form-footer">
        <div id="success_message">

        </div>
        <input type="hidden" id="token" value="{{ csrf_token() }}">
        <input type="hidden" id="inputIdPreviewComment" value="null">
        <input type="hidden" id="inputIdMain" value="null">
        <input type="hidden" id="inputIsMain" value="true">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mb-2 fade show" role="alert">
                <ul style="list-style-type: none; margin-bottom: 0">
                    @foreach ($errors->all() as $error)
                        <li>
{{--                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>--}}
                            {!! $error !!}
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
                        <div id="usernameError" class="form-text under_error"></div>
                        <div id="usernameHelp" class="form-text">Numbers and letters of the Latin alphabet.</div>
                    </div>
                    <div style="width: 32.3%; margin-left: 1.5%">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email" required
                               id="email" aria-describedby="emailHelp" placeholder="Email address">
                        <div id="emailError" class="form-text under_error"></div>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div style="width: 32.3%; margin-left: 1.5%">
                        <input type="text"
                               class="form-control @error('urlHomePage') is-invalid @enderror" name="urlHomePage"
                               id="homepage" aria-describedby="homepageHelp" placeholder="Home page">
                        <div id="homepageError" class="form-text under_error"></div>
                        <div id="homepageHelp" class="form-text">Your own url.</div>
                    </div>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="file" id="attachmentFiles" name="attachmentFiles" style="color: var(--text-color);"
                    onchange="uploadFile();">
                    <div id="attachmentFilesError" class="form-text under_error"></div>
                </div>
                <div>
                    <div id="imagePreview" class="imagePreview">

                    </div>
                </div>
                <div class="mb-3">
                    <textarea class="form-control @error('comment') is-invalid @enderror" style="height: 100px;" name="comment"
                              id="comment" aria-describedby="homepageHelp" placeholder="Your comment"></textarea>
                    <div id="commentError" class="form-text under_error"></div>
{{--                    <div contenteditable="true" class="form-control" id="comment" style="height: 70px;">--}}
{{--                    </div>--}}
{{--                    <div id="comment" contenteditable="true" class="form-control mb-1" style="height: 100px;"></div>--}}
                    <div id="checkResult" class="check-result mt-2"></div>
                    <div id="invisibleBlock" style="display: none"></div>
                </div>
                <div class="d-flex flex-row">
                    <div class="d-flex flex-row gap-2" style="width: 50%">
                        <div class="form-text under_error" style="font-size: 15px;">You can use this tags: </div>
                        <button type="button" class="button button-tags" onclick="addTag('a');">a</button>
                        <button type="button" class="button button-tags" onclick="addTag('code');">code</button>
                        <button type="button" class="button button-tags" onclick="addTag('i');">i</button>
                        <button type="button" class="button button-tags" onclick="addTag('strong');">strong</button>
                    </div>
                    <div class="d-flex flex-row-reverse" style="width: 50%">
                        <button class="button" type="button" id="preview-button">Pre-view message</button>
                        <button class="button" type="button" style="display: none;" id="close-preview-button">Close pre-view</button>
                        <button class="button me-2" type="button" style="display: none;" id="refresh-preview-button">Refresh pre-view</button>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column comment-container-right-side">
                <div>
                    <input type="text" name="captcha" id="captcha" class="form-control @error('captcha') is-invalid @enderror"
                           required placeholder="Captcha" />
                    <div id="captchaError" class="form-text under_error"></div>
                    <div class="captcha-container" id="captcha-container">
                        {!! captcha_img() !!}
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center button-send">
                    <button type="button" id="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--button-background-color)" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
            <div>
                <div class="pre-view_comment comment" id="preview-comment-container">
                    <div class="d-flex flex-row align-items-center
                     comment-title-container">
                        <div class="img-ava">
                            <img src="https://img.freepik.com/premium-vector/purple-circle-with-white-person-icon_876006-6.jpg"/>
                        </div>
                        <div class="title-name" id="username-preview">
                        </div>
                        <div class="title-timestamp" id="timestamp-preview">22.05.22 в 23:23</div>
                        <div class="title-review-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
                            </svg>
                        </div>
                    </div>
                    <div id="imagePreview-preview" class="imagePreview" style="margin-bottom: 20px;">

                    </div>
                    <div class="text-comment" id="comment-preview"></div>
            </div>
        </div>
    </form>
</div>
