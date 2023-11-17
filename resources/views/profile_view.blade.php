<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $info->username }}</title>
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
                        <img src="https://cdn.discordapp.com/avatars/{{ $info->id }}/{{ $info->avatar }}.webp"
                            alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                            style="width: 150px; z-index: 0">
                      </div>
                      <div class="ms-3" style="margin-top: 130px;">
                        <h5>{{ $info->username }} - {{ $info->id }}</h5>
                      </div>
                    </div>
                    <div class="p-4 text-white">
                      <div class="d-flex justify-content-end text-center py-1" style="color: white;">
                        <div class="px-3">
                          <p class="mb-1 h5">{{ count(\App\Models\Apply::where("user_id", $info->id)->get()) }}</p>
                          <p class="small text-white mb-0">Staff Applications</p>
                        </div>
                        @if($info->staff)
                          <div>
                            <p class="mb-1 h5">{{ count(\App\Models\event::where("user_id", $info->id)->get()) }}</p>
                            <p class="small text-white mb-0">Events</p>
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="card-body p-4 text-white">
                      <div class="mb-5">
                        <p class="lead fw-normal mb-1">About</p>
                        <div class="p-4" style="background-color: transparent;">
                            <p style="color: white">{{ $info->about }}</p>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center mb-4" style="padding: 10px 0; width: 100%;">
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
    @include("comps.footer")

    <script src="{{ asset("js/profile.js") }}"></script>
</body>
</html>