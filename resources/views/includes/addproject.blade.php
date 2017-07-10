<section id="addprojectform">
    <h2>Create a new project</h2>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <p class="error" style="display: block">{{ $error }}</p>
        @endforeach
    @endif
    <form action="/validate" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" placeholder="Project Name" name="project_name"  @if (count($errors) > 0) value="{{Request::old('project_name')}}"@endif>
        <input type="text" placeholder="Project Type" name="project_type" @if (count($errors) > 0) value="{{Request::old('project_type')}}"@endif>
        <input type="date" placeholder="Due Date (yyyy-mm-dd)" name="due" @if (count($errors) > 0) value="{{Request::old('due')}}"@endif>
        <input type="text" placeholder="Clients Name" name="client_name" @if (count($errors) > 0) value="{{Request::old('client_name')}}"@endif>
        <input type="email" placeholder="Clients Email" name="client_email" @if (count($errors) > 0) value="{{Request::old('client_email')}}"@endif>
        <textarea name="brief" placeholder="Provide a brief of this project [least 120 char]">@if (count($errors) > 0) {{Request::old('brief')}} @endif</textarea>
        <label for="contract">load a contract</label>
        <input type="file" id="contract" name="contract" @if (count($errors) > 0) value="{{Request::old('contract')}}"@endif>
        <label for="image">project image</label>
        <input type="file" id="image" name="image" @if (count($errors) > 0) value="{{Request::old('image')}}"@endif>
        <button type="submit" name="create" value="createproject">add project</button>
    </form>
</section>