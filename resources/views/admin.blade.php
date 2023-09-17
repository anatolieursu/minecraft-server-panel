<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("MINECRAFT_SERVER_NAME") }} - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/admin.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body>
    @include("comps.header")
    <div class="admin_panel">
        <p class="title" style="margin-top: 10px">Events</p>
        @if(count($events) > 0)
            @foreach ($events as $event)
                <a href="/event/view/{{ $event->user_id }}/{{ $event->id }}">
                    <div class="card card_info">
                    <div class="card-header">
                        Event {{ $event->title }} | {{ $event->version }}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p>{{ $event->content }}</p>
                        <footer class="blockquote-footer">Writed by <cite title="Source Title">{{ \App\Models\User::where("id", $event->user_id)->first()->username }}</cite></footer>
                        </blockquote>
                    </div>
                    <a href="/event/delete/{{ $event->id }}">
                        <button style="position: absolute; top: 5px; right: 5px; background-color: rgb(224, 103, 103); color: white; border: none; border-radius: 10px; padding: 10px 30px">Delete</button>
                    </a>
                    </div>
                </a>
            @endforeach

        @else
            <p style="text-align: center; color: white; font-family: Arial">No events found</p>
        @endif
        <p class="title">Forums</p>
        @if(count($qas) > 0)
            @foreach($qas as $card)
                <a href="/forum/view/{{ $card->user_id }}/{{ $card->id }}">
                    <div class="card" style="width: 100%; background-color: transparent; border: 1px solid white; color: white; margin: 0 auto; border-radius: 5px; margin-top: 10px; position: relative;">
                        <div class="card-body">
                        <h5 class="card-title">{{ $card->title }}</h5>

                        <div style="display: flex; justify-content: left; align-items: center;">
                            <img style="width: 30px; border-radius: 50%;" class="avatar" src="https://cdn.discordapp.com/avatars/{{ $card->user_id }}/{{ $card->avatar }}.webp" alt="{{ $card->username }}" />
                            <h6 style="margin-left: 10px; color: rgb(166, 166, 166);" class="card-subtitle mb-2">{{ $card->username }} | {{ $card->user_id }}</h6>
                        </div>

                        <p class="card-text" style="margin-top: 20px">{{ $card->description }}</p>
                        <a href="#" class="card-link">QA link</a>
                        <h6 style="color: rgb(166, 166, 166); position: absolute; right: 5px; bottom: 5px;" class="card-subtitle mb-2">{{ $card ->created_at }}</h6>
                        </div>

                        @if(Auth::user())
                            @if(Auth::user()->admin || Auth::user()->id == $card->user_id)
                                <a href="/forum/delete/{{ $card->id }}"><button class="delete_btn">Delete</button></a>
                            @endif
                        @endif
                    </div>
                </a>
            @endforeach
            @else
            <p style="text-align: center; color: white; font-family: Arial; margin-top: 10px;">No questions found</p>
        @endif
        <p class="title">Staff applications with checking status:</p>
        @if(count($applys) > 0)
            @foreach($applys as $card)
                <div class="card" style="width: 100%; background-color: transparent; border: 1px solid white; color: white; margin: 0 auto; border-radius: 5px; margin-top: 10px; position: relative;">
                    <div class="card-body">
                    <h5 class="card-title">Reason: {{ $card->reason }}</h5>

                    <div style="display: flex; justify-content: left; align-items: center;">
                        <img style="width: 30px; border-radius: 50%;" class="avatar" src="https://cdn.discordapp.com/avatars/{{ $card->user_id }}/{{ \App\Models\User::where("id", $card->user_id)->first()->avatar }}.webp" alt="{{ $card->username }}" />
                        <h6 style="margin-left: 10px; color: rgb(166, 166, 166);" class="card-subtitle mb-2">{{ $card->username }} | {{ $card->user_id }}</h6>
                    </div>

                    <p class="card-text" style="margin-top: 20px">Status: {{ $card->status }}</p>
                    <form action="/set-status/{{ $card->id }}">
                        <p>Set a new status for application</p>
                        <input required style="color: white; padding: 15px 30px; border: 1px solid black; background-color: transparent;" type="text" placeholder="Enter the new status" name="status" >
                        <button type="submit" style="border: none; padding: 15px 30px; border: 1px solid black; background-color: transparent; color: white;">Submit</button>
                    </form>
                    <h6 style="color: rgb(166, 166, 166); position: absolute; right: 5px; bottom: 5px;" class="card-subtitle mb-2">{{ $card ->created_at }}</h6>
                    </div>

                    @if(Auth::user())
                        @if(Auth::user()->admin || Auth::user()->id == $card->user_id)
                            <a href="/forum/delete/{{ $card->id }}"><button class="delete_btn">Delete</button></a>
                        @endif
                    @endif
                </div>
            @endforeach
            @else
            <p style="text-align: center; color: white; font-family: Arial; margin-top: 10px;">No staff applications with checking status found</p>
        @endif
    </div>
    @if($nr >= 3)
        <div style="width: 100%; height: 50px">

        </div>
        @include("comps.footer")
    @else
        <div style="position: absolute; bottom: 0; width: 100%"> 
            @include("comps.footer")
        </div>
    @endif
</body>
</html>