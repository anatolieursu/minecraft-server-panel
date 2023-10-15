<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $qa->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/forum_card.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body>
    @include("comps.header")
    <div class="forum_page">
        <div class="card" style="width: 95%; background-color: transparent; border: 1px solid white; color: white; margin: 0 auto; border-radius: 5px; margin-top: 10px; position: relative;">
            <div class="card-body">
            <h5 class="card-title">{{ $qa->title }}</h5>

            <div style="display: flex; justify-content: left; align-items: center;">
                <img style="width: 30px; border-radius: 50%;" class="avatar" src="https://cdn.discordapp.com/avatars/{{ $qa->user_id }}/{{ $qa->avatar }}.webp" alt="{{ $qa->username }}" />
                <h6 style="margin-left: 10px; color: rgb(166, 166, 166);" class="card-subtitle mb-2">{{ $qa->username }} | {{ $qa->user_id }}</h6>
            </div>

            <p class="card-text" style="margin-top: 20px">{{ $qa->description }}</p>
            <a href="#" class="card-link">QA link</a>
            <h6 style="color: rgb(166, 166, 166); position: absolute; right: 5px; bottom: 5px;" class="card-subtitle mb-2">{{ $qa ->created_at }}</h6>
            </div>

            @if($acces)
                <a href="/forum/delete/{{ $forum_id }}"><button class="delete_btn">Delete</button></a>
            @endif
        </div>
        <div style="width: 100%;">
            <div class="messages" style="width: 80%; padding: 20px 0; margin: 0 auto;">
                @if(count($messages) > 0)
                    @foreach($messages as $message)
                        @php
                            $role = "Staff";
                            if($message->username == $qa->username) {
                                $role = "Author";
                            }
                        @endphp
                        <a href="#form_for_adding_message">
                            <div id="{{ $message->id }}" class="alert alert-success" role="alert" style="background-color: rgba(0,0,0,.3); color: white;">
                                @if(isset($message->reply_from_msg_id))
                                    @php
                                        $infoAboutReplyFromId = App\Models\Message::where("id", $message->reply_from_msg_id)->first();
                                        if(!$message->reply_from_msg_id) {
                                            $content = "undefined";
                                            $author = "undefined";
                                        } else {
                                            $content = $infoAboutReplyFromId->content;
                                            $author = $infoAboutReplyFromId->username;
                                        }
                                    @endphp
                                    <p>Reply from {{ $author }} - '{{ $content }}'</p>
                                @endif
                                <h4 class="alert-heading">{{ $message->username }} ({{ $role }})</h4>
                                <p>{{ $message->content }}</p>
                                <hr>
                                <p class="mb-0">{{ $message->created_at }}</p>
                                @if($acces)
                                    <button class="btn mt-1 btn-secondary" onclick="setReply({{ $message->id }}, '{{ $message->content }}', '{{ $message->username }}')">Reply</button>
                                @endif
                            </div>
                        </a>
                    @endforeach

                    @else
                    <p style="color: white; text-align: center">No comments found</p>
                @endif

                @if($acces)
                    <form action="/forum/comment/{{ $forum_id }}" method="post" class="mt-2" id="form_for_adding_message" >
                        @csrf
                        <div class="mb-3">
                            <input type="text" style="display: none;" id="replyFrom" name="replyFrom">
                            <label for="exampleFormControlTextarea1" style="color: white" id="labelTextForReply"></label>
                            <input type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter the message" name="content">
                            <button type="submit" class="btn btn-success mt-1" style="width: 100%">Submit</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    @if(count($messages) < 1)
        <div style="width: 100%; position: absolute; bottom: 0; left: 0">
            @include("comps.footer")
        </div>
    @else
        <div style="width: 100%; height: 20px">

        </div>
        @include("comps.footer")
    @endif
    <script src="{{ asset("js/forum_card.js") }}"></script>
</body>
</html>