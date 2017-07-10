<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @if($page == "dashboard/profile")
        <title>Profile | @foreach($user as $u) {{ $u->firstname }} {{ $u->lastname }} @endforeach</title>
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @elseif($page == "dashboard/profile/edit")
        <title>Edit Profile</title>
        <link rel="stylesheet" href="{{ asset('css/editprofile.css') }}">
    @elseif($page == "dashboard/projects")
        <title>Projects | @foreach($user as $u) {{ $u->companyname }} @endforeach </title>
        <link rel="stylesheet" href="{{ asset('css/projects.css') }}">
    @elseif($page == "dashboard/projects/{project_name}")
        <title>Project: @foreach($project as $p) {{ $p->projectname }} @endforeach</title>
        <link rel="stylesheet" href="{{ asset('css/project.css') }}">
    @elseif($page == "dashboard/create")
        <title>Dashboard | Create New Project</title>
        <link rel="stylesheet" href="{{ asset('css/createproject.css') }}">
    @else
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endif
</head>
<body>

    @include('includes.topbar')

    <main>
        @if($page == "dashboard/profile")
            @include('includes.profile')
        @elseif($page == "dashboard/profile/edit")
            @include('includes.editprofile')
        @elseif($page == "dashboard/projects")
            @include('includes.projects')
        @elseif($page == "dashboard/create")
            @include('includes.addproject')
        @elseif($page == "dashboard/projects/{project_name}")
            @include('includes.current_project')
        @elseif($page == "dashboard/settings")
            @include('includes.settings')
        @elseif($page == "dashboard")
            @include('includes.dashboard')
        @endif
    </main>

    <script src="{{ asset('jss/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('jss/dashboard.js') }}"></script>

</body>
</html>