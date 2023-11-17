<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event {{ $data->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/event_view.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body  @if(!empty(env("BACKGROUND_COLOR")))
style="background-color: {{ env("BACKGROUND_COLOR") }} !important;"
@endif>
    @include("comps.header")
    <div class="event_view_page">
        <div class="card" style="width: 95%; background-color: transparent; border: 1px solid white; color: white; margin: 0 auto; border-radius: 5px; margin-top: 10px; position: relative;">
            <div class="card-body">
            <h5 class="card-title">{{ $data->title }} | Event Version: {{ $data->version }}</h5>
                @php
                    $username = \App\Models\User::where("id", $data->user_id)->first()->username;
                @endphp
            <div style="display: flex; justify-content: left; align-items: center;">
                <img style="width: 30px; border-radius: 50%;" class="avatar" src="https://cdn.discordapp.com/avatars/{{ $data->user_id }}/{{ \App\Models\User::where("id", $data->user_id)->first()->avatar }}.webp" alt="{{ $username }}" />
                <h6 style="margin-left: 10px; color: rgb(166, 166, 166);" class="card-subtitle mb-2">{{ $username }} | {{ $data->user_id }}</h6>
            </div>

            <p class="card-text" style="margin-top: 20px">{{ $data->content }}</p>
            <h6 style="color: rgb(166, 166, 166); position: absolute; right: 5px; bottom: 5px;" class="card-subtitle mb-2">{{ $data ->created_at }}</h6>
            </div>
            <img src="{{ str_replace(config("app.path"), '', $data->image_path) }}" alt="{{ $data->title }}">
        </div>
    </div>
</body>
</html>