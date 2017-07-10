<section id="login">
    <div>
        <h2>login</h2>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="error" style="display: block">{{ $error }}</p>
            @endforeach
        @else
            <p class="error">&nbsp;</p>
        @endif
        @if(session('error'))
            <p class="error" style="display: block">{{ session('error') }}</p>
        @endif
        <form method="post" action="validate">
            {{ csrf_field() }}
            <input type="text" placeholder="username" name="username" @if (count($errors) > 0) value="{{Request::old('username')}}"@endif>
            <a href="">forgot username?</a>
            <input type="password" placeholder="password" name="pass" @if (count($errors) > 0) value="{{Request::old('pass')}}"@endif>
            <a href="">forgot password?</a>
            <input type="checkbox" id="remember" name="rememberusername">
            <label for="remember">Remember me</label>
            <button type="submit" name="login" value="login">login</button>
        </form>
    </div>
</section>