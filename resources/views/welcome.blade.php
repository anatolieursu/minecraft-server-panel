<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/index.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>
    <title>{{ env("MINECRAFT_SERVER_NAME") }} | Minecraft Server</title>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body>
    @include("comps.header")

    {{-- Hero PAGE: All rights reserved - Ursu Anatolie --}}
    <div class="hero_page">
        <div class="card w-100 mb-3 card_info">
            <div class="card-body">
              <h5 class="card-title">{{ env("MINECRAFT_SERVER_NAME") }} Minecraft Server</h5>
              <p class="card-text">It's time to test your skill in our next Hypixel Tournament, Wool Wars 4v4!
                If you don't know about tournaments or the Tournament Hall, or if you'd like to know more about some of the terms in this post, make sure to take a look at the first tournament post.</p>
              <a href="#" class="btn btn-primary">{{ $players }} Members Online</a>
              <img src="https://wallpapers.com/images/featured/minecraft-s2kxfahyg30sob8q.jpg" alt="{{ env("MINECRAFT_SERVER_NAME") }}" class="image_minecraft" draggable="false">
            </div>
        </div>
        @if(count($events) > 0)
          @foreach ($events as $event)
          {{-- /event/view/{{ $event->user_id }}/{{ $event->id }} --}}
            <a href="{{ route("event.view", [$event->user_id, $event->id]) }}" id="{{ $event->title }}">
              <div class="card card_info"
                @if(isset($_GET["id"]))
                  @if($event->id == $_GET["id"])
                    style="background-color: rgba(146, 146, 248, 0.3) !important;"
                  @endif
                @endif
                @if(session("allContains"))
                  @if(in_array($event->id, session("allContains")))
                    style="background-color: rgba(146, 146, 248, 0.3) !important;"
                  @endif
                @endif
              >
                <div class="card-header">
                  Event {{ $event->title }} | {{ $event->version }}
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>{{ $event->content }}</p>
                    <footer class="blockquote-footer">Writed by <cite title="Source Title">{{ \App\Models\User::where("id", $event->user_id)->first()->username }}</cite></footer>
                  </blockquote>
                </div>
                @if(Auth::user())
                  @if(Auth::user()->id == $event->user_id)
                    <a href="{{ route("event.delete", $event->id) }}">
                      <button style="position: absolute; top: 5px; right: 5px; background-color: rgb(224, 103, 103); color: white; border: none; border-radius: 10px; padding: 10px 30px">Delete</button>
                    </a>
                  @endif
                @endif
              </div>
            </a>
          @endforeach
        @else
          <p style="font-family: Arial; text-align: center; color: white">No events found</p>
        @endif
        @php
          session()->forget('allContains');
        @endphp
    </div>
    @if(session("allContains"))
      @php
        session()->forget("allContains");
      @endphp
    @endif
    {{-- Hero PAGE: All rights reserved - Ursu Anatolie --}}

    @include("comps.footer")

    <script src="{{ asset("js/index.js") }}"></script>
</body>
</html>