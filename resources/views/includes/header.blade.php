<header>
    <div class="wrapper">
        <h1><a href="/"><img src="media/logo.svg" alt=""></a></h1>
        <button id="menu_btn">menu</button>
        @if($page == "home")
            <div id="welcome_msg">
                <h2>Let us show to your clients that <b>you are serious about your job</b></h2>
                <a href="signup">signup for <b>free</b></a>
            </div>
        @endif
    </div>
    @if($page == "home")
        @include('includes.code')
    @endif
</header>