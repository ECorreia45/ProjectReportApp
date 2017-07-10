@foreach($project as $p)
    <header>
        <img src="../../storage/{{ $p->image }}" alt="{{ $p->projectname }}">
        <div>
            <h2>{{ $p->projectname }}</h2>
            <p><b>client:</b> ecorreia.design</p>
            <p>download: <a href="{{ asset($p->contract) }}" download="">contract</a></p>
            <p><b>due date:</b> {{ $p->duedate }}</p>
        </div>
        <p><b>brief:</b>{{ $p->brief }}</p>
    </header>
    <button type="button">post a progress</button>
    <form action="/validate" method="post" enctype="multipart/form-data" id="addprogress" @if (count($errors->progress) > 0) style="display: block" @endif>
        {{ csrf_field() }}
        @foreach ($errors->progress->all() as $error)
            <p class="error" style="display: block">{{ $error }}</p>
        @endforeach
        <input type="text" placeholder="Title" name="title" @if (count($errors->progress) > 0) value="{{Request::old('title')}}"@endif>
        <label for="prgressimage">load a file</label>
        <input type="file" id="prgressimage" name="file" @if (count($errors->progress) > 0) value="{{Request::old('file')}}"@endif>
        <textarea name="detail" placeholder="Detail about this progress" @if (count($errors->progress) > 0) value="{{Request::old('detail')}}"@endif></textarea>
        <button type="submit" name="progress" value="{{ $p->projectname }}">post</button>
    </form>
    <section id="timeline">
        @foreach($timeline as $t)
            <div class="progress" id="p1">
                <h3>{{ $t->title }}</h3>
                <div>
                    <img src="../../storage/{{ $t->file }}" alt="{{ $t->file }}">
                    <p>{{ $t->detail }}</p>
                    <button>give feedback</button>
                    <form action="/validate" method="post" enctype="multipart/form-data" id="addfeedback" @if (count($errors->feedback) > 0) style="display: block" @endif>
                        {{ csrf_field() }}
                        @foreach ($errors->feedback->all() as $error)
                            <p class="error" style="display: block">{{ $error }}</p>
                        @endforeach
                        <input type="text" value="{{ $t->title }}" name="title" style="display:none;">
                        <textarea name="response" placeholder="detail about this progress" @if (count($errors->feedback) > 0) value="{{Request::old('response')}}"@endif></textarea>
                        <button type="submit" name="feedback" value="{{ $p->projectname }}">send</button>
                    </form>
                    @foreach($feedback as $f)
                        @if($t->timelineid == $f->timelineid)
                            <div class="feedback" id="f1">
                                <p><b>client said: </b>{{ $f->feedback }}</p>
                                <p class="date">on {{ $f->date }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endforeach