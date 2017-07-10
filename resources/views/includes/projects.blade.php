@foreach($projects as $p)
    <a href="projects/{{ $p->projectname }}" class="project">
        <img src="../storage/{{ $p->image }}" alt="{{ $p->projectname }} image">
        <h2>{{ $p->projectname }}</h2>
        <p>due: {{ $p->duedate }}</p>
    </a>
@endforeach
<a href="/dashboard/create" id="addnewproject"><span>start a new project</span></a>