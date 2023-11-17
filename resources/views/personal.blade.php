<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("MINECRAFT_SERVER_NAME") }} Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/personal.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body  @if(!empty(env("BACKGROUND_COLOR")))
style="background-color: {{ env("BACKGROUND_COLOR") }} !important;"
@endif>
    @include("comps.header")
    <div class="personal_page">
        @if(count($staff) > 0)
            @foreach ($staff as $staff_categ => $sectionData)
                <div class="categ">
                    <p class="categ_of_staff">{{ $staff_categ }}</p>
                    <hr>
                    @foreach ($sectionData as $data)
                        <div class="card mb-3" style="width: 100%; color: white; background-color: transparent;  ">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p style="color: white; text-align: center">No staff found</p>
        @endif
    </div>

    @if($nr < 4)
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