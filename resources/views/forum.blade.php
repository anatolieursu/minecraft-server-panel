<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("MINECRAFT_SERVER_NAME") }} Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/forum.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body>
    @include("comps.header")
    <div class="forum_page">
        @if(count($qas) > 0)
                @foreach($qas as $card)
                    <a href="/forum/view/{{ $card->user_id }}/{{ $card->id }}">
                        <div class="card" style="width: 80%; background-color: transparent; border: 1px solid white; color: white; margin: 0 auto; border-radius: 5px; margin-top: 10px; position: relative;">
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
    </div>

    @if(count($qas) <= 2)
        <div style="width: 100%; position: absolute; bottom: 0; left: 0">
            @include("comps.footer")
        </div>
    @else
        <div style="width: 100%; height: 20px">

        </div>
        @include("comps.footer")
    @endif
</body>
</html>