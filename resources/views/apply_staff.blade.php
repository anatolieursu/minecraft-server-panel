<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("MINECRAFT_SERVER_NAME") }} Staff Apply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/apply.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body  @if(!empty(env("BACKGROUND_COLOR")))
style="background-color: {{ env("BACKGROUND_COLOR") }} !important;"
@endif>
    @include("comps.header")
    
    <div class="apply_staff">
        <div class="apply_panel">
            <img src="https://media.discordapp.net/attachments/1096673430646030396/1145787357681963008/novaskin-wallpaper-vsgiantday_1.jpg?width=994&height=559" alt="JoinInOurTeam">
            <div class="theForm">
                @if(Auth::user())
                    <form action="/staff/apply" method="post">
                        @csrf
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Your age</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="age">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Why staff ?</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="reason">
                        </div>
                        <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" required id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">I have read and I agree with the regulation!</label>
                        </div>
                        <div id="emailHelp" class="form-text" style="color: white">The staff will have a look at your profile here. Make sure you have set your profile description (about me)!</div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
                  </form>

                  @else

                  <a href="/login"><button class="btn btn-primary">Log-in with discord to apply for staff</button></a>
                @endif
            </div>
        </div>
    </div>
    <div style="width: 100%; height: 25vh">
    </div>

    @include("comps.footer")
</body>
</html>