<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile @if(Auth::user())
      {{ Auth::user()->username }}
    @endif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("cssfiles/profile.css") }}">
    <script src="https://kit.fontawesome.com/8331b878b2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="{{ env("SERVER_IMAGE") }}">
</head>
<body  @if(!empty(env("BACKGROUND_COLOR")))
style="background-color: {{ env("BACKGROUND_COLOR") }} !important;"
@endif>
    @include("comps.header")
    <div class="profile_page">
        <section class="h-100">
            <div class="container py-2 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7" style="width: 100%;">
                  <div class="card" style="background-color: transparent; color: black;">
                    <div class="rounded-top text-white d-flex flex-row bg-dark" style=" height:200px;">
                      <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                        @if(!Auth::user())
                            <img src="https://img.icons8.com/?size=512&id=23264&format=png"
                            alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                            style="width: 150px; z-index: 0">
                          @else
                            <img src="https://cdn.discordapp.com/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}.webp" alt="{{ Auth::user()->username }}#{{ Auth::user()->discriminator }}"
                            alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                            style="width: 150px; z-index: 0">
                        @endif
                        
                        @if(!Auth::user())
                          <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                          style="z-index: 0; color: white;">
                            <a href="/login">Login</a>
                          </button>
                          @else
                          <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                          style="z-index: 0; color: white;">
                            <a href="/logout-user">Logout</a>
                          </button>
                        @endif
                      </div>
                      <div class="ms-3" style="margin-top: 130px;">
                        @if(Auth::user())
                          <h5>{{ Auth::user()->username }} - @if(Auth::user()->public)
                            Public
                          @else
                            Private
                          @endif</h5>
                          <p>{{ Auth::user()->id }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="p-4 text-white">
                      <div class="d-flex justify-content-end text-center py-1" style="color: white;">
                        @if(isset($applys))
                          <div class="px-3">
                            <p class="mb-1 h5">{{ count($applys) }}</p>
                            <p class="small text-white mb-0">Staff Applications</p>
                          </div>
                        @endif
                        @if(Auth::user())
                          @if(Auth::user()->staff || Auth::user()->admin)
                            <div>
                              <p class="mb-1 h5">{{ $nrOfEvents }}</p>
                              <p class="small text-white mb-0">Events</p>
                            </div>
                          @endif
                        @endif
                      </div>
                    </div>
                    <div class="card-body p-4 text-white">
                      <div class="mb-5">
                        <p class="lead fw-normal mb-1">About</p>
                        <div class="p-4" style="background-color: transparent;">
                          @if(Auth::user())
                            <p style="color: white">{{ Auth::user()->about }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center mb-4" style="padding: 10px 0; width: 100%;">
                        <div class="buttons_profile">
                          <button id="addForumPanel" type="button" class="btn btn-primary" >
                            Add a Forum Question
                          </button>
                          <button id="openAboutMePanel" type="button" class="btn btn-primary" >
                            Set the about me
                          </button>
                          @if(Auth::user())
                            @if(Auth::user()->public)
                              <a href="{{ route("profile.private") }}">
                                <button type="button" class="btn btn-danger" >
                                  Private Account
                                </button>
                              </a>
                              @else
                                <a href="{{ route("profile.public") }}">
                                  <button type="button" class="btn btn-primary" style="background-color: rgb(64, 140, 64); border: 1px solid rgb(64,140,64);" >
                                    Public Account
                                  </button>
                                </a>
                            @endif
                            @if(Auth::user()->staff || Auth::user()->admin)
                              <button id="openEventPostBtn" type="button" class="btn btn-primary" >
                                Post an event
                              </button>
                            @endif
                          @endif
                        </div>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="lead fw-normal mb-0">Recent Activity</p>
                      </div>
                      {{-- ALL ACTIVITY CARDS --}}
                      @if(isset($applys))
                        @foreach($applys as $apply)
                          <div class=" w-100 mb-3 card_info" style="background-color: transpanret; color: white; border: 1px solid white;">
                            <div class="card-body" style="background-color: transparent">
                              <h5 class="card-title">In Staff Application</h5>
                              <p class="card-text">Applied on {{ $apply->created_at }}</p>
                              <p class="card-text">Status: {{ $apply->status }}</p>
                            </div>
                          </div>
                        @endforeach
                      @endif
                      @if(isset($forums))
                        @foreach($forums as $forum)
                          <div class=" w-100 mb-3 card_info" style="background-color: transpanret; color: white; border: 1px solid white;">
                            <div class="card-body" style="background-color: transparent">
                              <h5 class="card-title">In Forum</h5>
                              <p class="card-text">{{ $forum->title }}</p>
                              <a href="/forum/view/{{ $forum->user_id }}/{{ $forum->id }}" class="btn btn-primary">View</a>
                            </div>
                          </div>
                        @endforeach
                      @endif
                      {{-- ALL ACTIVITY CARDS --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>
    <div id="forumPanel" style="position: fixed; width: 100%; height: 100%; top: 0; display: none; justify-content: center; align-items: center; background-color: rgba(0,0,0,.7)">
      <div style="padding: 25px; background-color: #424649c7; border-radius: 5px; width: 50%">
        <form action="{{ route("forum.create") }}" method="post">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInputDisabled" placeholder="Enter the title for forum" name="title">
            <label for="floatingInputDisabled">Forum's Title</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="description" placeholder="Leave the description here" id="floatingTextarea2Disabled" style="height: 100px"></textarea>
            <label for="floatingTextarea2Disabled">Description</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="floatingSelectDisabled" aria-label="Floating label disabled select example" name="urgency" >
              <option selected value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <label for="floatingSelectDisabled">Urgency's level</label>
          </div>
          <button type="submit" class="btn btn-primary" style="margin-top: 10px; width: 100%;">Submit</button>
          <button type="button" id="closePanelForum" class="btn btn-secondary" style="margin-top: 10px; width: 100%;">Close</button>
        </form>
      </div>
    </div>

    <div id="setAboutMePanel" style="position: fixed; width: 100%; height: 100%; top: 0; display: none; justify-content: center; align-items: center; background-color: rgba(0,0,0,.7)">
      <div style="padding: 25px; background-color: #424649c7; border-radius: 5px; width: 50%">
        <form action="{{ route("about_me.set") }}" method="post">
          @csrf
          <div class="form-floating mb-3">
            <textarea class="form-control" name="aboutMe" placeholder="Set The About Me" id="floatingTextarea2Disabled" style="height: 100px">@if(Auth::user()){{ Auth::user()->about }}@endif</textarea>
            <label for="floatingTextarea2Disabled">About Me</label>
          </div>
          <button type="submit" class="btn btn-primary" style="margin-top: 10px; width: 100%;">Submit</button>
          <button type="button" id="closeAboutMe" class="btn btn-secondary" style="margin-top: 10px; width: 100%;">Close</button>
        </form>
      </div>
    </div>

    <div id="postAnEvent" style="position: fixed; width: 100%; height: 100%; top: 0; display: none; justify-content: center; align-items: center; background-color: rgba(0,0,0,.7)">
      <div style="padding: 25px; background-color: #424649c7; border-radius: 5px; width: 50%">
        <form action="{{ route("event.create") }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInputDisabled" placeholder="Enter the title for event" name="title">
            <label for="floatingInputDisabled">Event Title</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="content" placeholder="Set The About Me" id="floatingTextarea2Disabled" style="height: 100px"></textarea>
            <label for="floatingTextarea2Disabled">Event Content</label>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label" style="color: white">Enter the files of event</label>
            <input class="form-control" type="file" id="formFile" name="file">
          </div>
          <button type="submit" class="btn btn-primary" style="margin-top: 10px; width: 100%;">Submit</button>
          <button type="button" id="closeEventPanel" class="btn btn-secondary" style="margin-top: 10px; width: 100%;">Close</button>
        </form>
      </div>
    </div>
    @include("comps.footer")

    <script src="{{ asset("js/profile.js") }}"></script>
</body>
</html>