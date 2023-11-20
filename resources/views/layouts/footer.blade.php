<div class="footer">
    <form action="#" method="POST" class="main-form-add-comment">
        @csrf

        @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="d-flex flex-row">
            <div style="width: 85%;">
                <div class="mb-3 d-flex flex-row">
                    <div style="width: 32.3%">
                        <input type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               id="username" aria-describedby="usernameHelp" placeholder="User Name"
                               required>
                        <div id="usernameHelp" class="form-text">Numbers and letters of the Latin alphabet.</div>
                    </div>
                    <div style="width: 32.3%; margin-left: 1.5%">
                        <input type="email"
                               class="form-control"
                               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div style="width: 32.3%; margin-left: 1.5%">
                        <input type="text"
                               class="form-control"
                               id="homepage" aria-describedby="homepageHelp" placeholder="Home page">
                        <div id="homepageHelp" class="form-text">Your own url.</div>
                    </div>
                </div>
                <div>
                    <textarea class="form-control" style="height: 100px;"
                              id="text" aria-describedby="homepageHelp" placeholder="Your comment"></textarea>
                </div>
            </div>
            <div style="width: 14%;" class="d-flex justify-content-center align-items-center button-send">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--button-background-color)" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
            </div>
        </div>

{{--        <button type="submit" class="button">Send</button>--}}

    </form>
</div>
