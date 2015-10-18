<!DOCTYPE html>
<html>
    <head>
        <title>Worst Things in the World!</title>
        <link rel="stylesheet" type="text/css" href="/css/app.css">

    </head>
    <body>
        <div id="content">
            <header>
                <h1>The World's Worst Things!</h1>
                <h2 id="subtitle">A collection of the very worst things in the whole wide world</h2>
            </header>
            <div id="worst-things"> 
                @foreach ($worstThings as $index => $worstThing)
                    <div class="worst-thing">
                        <span class="index">#{{$index + 1}}</span>
                        <h2 class="name">{{$worstThing->getName()}}</h2>
                        <img src="{{$worstThing->getImage()->getUri()}}">
                        <div class="footnote">
                            <span class="poster">Posted by {{$worstThing->getPoster()->getName()}} &mdash; </span>
                            <time class="datetime-posted" datetime="{{$worstThing->getCreatedDatetime()->format('Y-m-d H:i:s')}}"></time>
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
