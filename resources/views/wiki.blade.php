<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("MINECRAFT_SERVER_NAME") }} Wiki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/wiki.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body  @if(!empty(env("BACKGROUND_COLOR")))
style="background-color: {{ env("BACKGROUND_COLOR") }} !important;"
@endif>
    @include("comps.header")
    <div class="wiki_page">
        <div class="menu_img" id="openWikiPanel">
            <img src="https://img.icons8.com/?size=512&id=12470&format=png" alt="">
        </div>
        <div style="display: flex; justify-content: center; width: 100%;">
            <nav id="sidebarMenu" class="d-lg-block sidebar collapse" style="width: 25%">
                <div class="position">
                  <div class="list-group list-group-flush" style="width: 300px">
                    @if(count($wikis) > 0)
                        @foreach ($wikis as $section => $wiki)
                            <div class="section_categ" >
                                <p>{{ $section }}</p>
                                <hr>
                                @foreach($wiki as $categ)
                                    <a href="/wiki/view/{{ $categ["button_name"] }}" class="list-group-item list-group-item-action py-2 ripple" style="background-color: rgba(199, 199, 199, 0.083); color: white">
                                        <span>{{ $categ["button_name"] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p style="text-align: center; color: white;">No wikis found</p>
                    @endif
                  </div>
                </div>
            </nav>

            <div style="width: 75%" class="content-wiki" id="content_wiki">
                @if(isset($categoryWIKI))
                    <p style="margin: 20px 0; font-size: 40px; font-weight: bold">{{ $categoryWIKI["title"] }}</p>
                    <p>{{ $categoryWIKI["content"] }}</p>
                    <img src="{{ $categoryWIKI["image_path"] }}" alt="{{ $categoryWIKI["image_path"] }}">
                    <div style="width: 100%; height: 150px">

                    </div>
                @else
                    <p style="margin: 20px 0; font-size: 40px; font-weight: bold">{{ env("MINECRAFT_SERVER_NAME") }} Documentation</p>
                    <p>Here you will find all of the documentaion! How to enter the server? Add the IP {{ env("MINECRAFT_SERVER_IP") }} to the list of servers and press join! Nice game...</p>
                @endif
            </div>
        </div>
    </div>
    <div style="width: 100%; position: fixed; bottom: 0; left: 0">
        @include("comps.footer")
    </div>
    <script src="{{ asset("js/wiki.js") }}"></script>
</body>
</html>