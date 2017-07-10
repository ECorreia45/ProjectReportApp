@foreach($user as $u)
    <section id="profile">
        <img src="{{ asset($u->photo) }}" alt="{{ $u->companyname }}">
        <div>
            <h2>{{ $u->firstname }} {{ $u->lastname }}</h2>
            <p><b>Company:</b>{{ $u->companyname }}</p>
            <p><b>Website</b>: <a href="{{ $u->site }}">{{ $u->site }}</a></p>
            <p><b>Email:</b> <a href="mailto:{{ $u->email }}">{{ $u->email }}</a></p>
            <p><b>Reputation:</b> {{ $u->reputaion }}</p>
        </div>
        <p><b>About:</b> {{ $u->about }}</p>
        <section>
            <h3>Skills:</h3>
        </section>
        <section>
            <h3>Education:</h3>
        </section>
        <section>
            <h3>Projects:</h3>
        </section>
        <section>
            <h3>Clients worked with:</h3>
        </section>
        <h3>Find me at:</h3>
        <address>
            <a href="{{ $u->facebook }}">Facebook</a>
            <a href="{{ $u->twitter }}">twitter</a>
            <a href="{{ $u->instagram }}">instagram</a>
        </address>
    </section>
@endforeach