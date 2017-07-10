<noscript>
    <section id="signup">
        <div class="wrapper">
            <h2>Signup</h2>
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <p class="error" style="display: block">{{ $error }}</p>
                @endforeach
            @else
                <p class="error local">&nbsp;</p>
            @endif
            <form method="post" action="validate" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="email" placeholder="email" name="email" @if (count($errors) > 0) value="{{Request::old('email')}}"@endif>
                <input type="text" placeholder="first name" name="firstname" @if (count($errors) > 0) value="{{Request::old('firstname')}}"@endif>
                <input type="text" placeholder="last name" name="lastname" @if (count($errors) > 0) value="{{Request::old('lastname')}}"@endif>
                <input type="text" placeholder="username" name="username" @if (count($errors) > 0) value="{{Request::old('username')}}"@endif>
                <input type="password" placeholder="password" name="password" @if (count($errors) > 0) value="{{Request::old('password')}}"@endif>
                <input type="password" placeholder="verify password" name="password_verification" @if (count($errors) > 0) value="{{Request::old('password_verification')}}"@endif>
                <label for="logo"></label>
                <input type="file" name="logo" id="logo" @if (count($errors) > 0) value="{{Request::old('logo')}}"@endif>
                <button type="submit" name="signup" value="signup">></button>
            </form>
        </div>
    </section>
</noscript>
<section id="signup" style="display: none;">
    <div class="wrapper">
        <h2>Signup</h2>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="error" style="display: block">{{ $error }}</p>
            @endforeach
        @else
            <p class="error local">&nbsp;</p>
        @endif
        <form method="post" action="validate" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset id="current">
                <input type="email" placeholder="email" name="email" @if (count($errors) > 0) value="{{Request::old('email')}}"@endif>
            </fieldset>
            <fieldset>
                <input type="text" placeholder="first name" name="firstname" @if (count($errors) > 0) value="{{Request::old('firstname')}}"@endif>
                <input type="text" placeholder="last name" name="lastname" @if (count($errors) > 0) value="{{Request::old('lastname')}}"@endif>
            </fieldset>
            <fieldset>
                <input type="text" placeholder="username" name="username" @if (count($errors) > 0) value="{{Request::old('username')}}"@endif>
                <input type="password" placeholder="password" name="password" @if (count($errors) > 0) value="{{Request::old('password')}}"@endif>
                <input type="password" placeholder="verify password" name="password_verification" @if (count($errors) > 0) value="{{Request::old('password_verification')}}"@endif>
            </fieldset>
            <fieldset>
                <label for="logo"></label>
                <input type="file" name="logo" id="logo" @if (count($errors) > 0) value="{{Request::old('logo')}}"@endif>
            </fieldset>
            <button type="submit" name="signup" value="signup">></button>
        </form>
    </div>
</section>