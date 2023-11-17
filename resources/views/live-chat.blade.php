<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("MINECRAFT_SERVER_NAME") }} Live Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/chat.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        let start = 0;
        let postUrl = $("#app_url").text() + '/chat/store'
        let getUrl = $("#app_url").text() + '/chat/load'
        let author = null;
        $(document).ready(function() {
            load();
            $("#sendMessageForm").submit(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if(author === null) {
                    let from = prompt("Enter your name");
                    author = from;
                }
                $.post(postUrl, { 
                    message: $("#message").val(),
                    author: author
                }, function(data) {
                    
                });
                $("#message").val('');
            });
        });
        function load() {
            $.get(getUrl + "?start=" + start, function(e) {
                if(Array.isArray(e)) {
                    e.forEach(item => {
                        start = item.id;
                        $("#messages").prepend(renderMessage(item))
                    })
                }
                load();
            })
        }
        function renderMessage(item) {
            let date = new Date(item.created_at)
            let newDate = `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`

            return `
            <div class='message_categ'>
                <p>${item.author} - </p>
                <p>${item.message} (${newDate})</p>    
            </div>
            `
        }
    </script>
</head>
<body  @if(!empty(env("BACKGROUND_COLOR")))
style="background-color: {{ env("BACKGROUND_COLOR") }} !important;"
@endif>
    @include("comps.header")
    <div class="container_username">
        <p id="app_url" style="display: none">{{ env("APP_URL") }}</p>
        <form method="POST" class="input-group mb-3" id="sendMessageForm" method="post">
            @csrf
            <input type="text" class="form-control" id="message" placeholder="Message">
            <button class="btn btn-primary" id="send_message_btn">Send Message</button>
        </form>
        <div id="messages">

        </div>
    </div>

    <div style="width: 100%; height: 150px"></div>
    <div style="width: 100%; position: fixed; bottom: 0; left: 0;">
        @include('comps.footer')
    </div>

    <script src="{{ asset("js/live-chat.js") }}"></script>
</body>
</html>