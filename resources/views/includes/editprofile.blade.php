<form action="/validate" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <p class="error" style="display: block">{{ $error }}</p>
        @endforeach
    @endif
    <h2>Edit Your Profile</h2>
    <label for="logo">upload a new logo</label>
    <input type="file" id="logo" name="logo">
    <input type="text" name="fname" placeholder="First name">
    <input type="text" name="lname" placeholder="Last name">
    <input type="text" name="cname" placeholder="Company name/brand">
    <input type="url" name="site" placeholder="Website">
    <input type="email" name="email" placeholder="Email">
    <textarea name="about" placeholder="Tell them about you"></textarea>
    <input type="url" name="facebook" placeholder="Facebook link">
    <input type="url" name="twitter" placeholder="Twitter link">
    <input type="url" name="instagram" placeholder="Instagram link">
    <button type="submit" name="editprofile" value="editprofile">post change</button>
</form>