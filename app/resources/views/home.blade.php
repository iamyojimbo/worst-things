<!DOCTYPE html>
<html>
    <head>
        <title>Worst Things in the World!</title>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="content">
            <header>
                <h1>The World's Worst Things!</h1>
                <h2 id="subtitle">A collection of the very worst things in the whole wide world</h2>
            </header>
{{--             <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">Login with Facebook</fb:login-button>
            <div id="status"></div> --}}

            <div id="worst-things"> 
                @foreach ($worstThings as $index => $worstThing)
                    <div class="worst-thing" data-id="{{$worstThing['id']}}">
                        <span class="index">#{{$index + 1}}</span>
                        <h2 class="name">{{$worstThing["name"]}}</h2>
                        <span class="downvote">
                            <span class="downvote-count">{{$worstThing["downvotes"]}}</span>
                            <button type="submit"><span class="downvote-icon fa fa-thumbs-down"></span></button>
                        </span>
                        <img src="{{$worstThing['image']->uri()}}">
                        <div class="footnote">
                            <span class="poster">Posted by {{$worstThing["poster"]["fullName"]}} &mdash; </span>
                            <time class="datetime-posted" datetime="{{$worstThing['createdDateTime']->format('Y-m-d H:i:s')}}"></time>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Scripts --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="/js/all.js"></script>

    </body>
</html>
