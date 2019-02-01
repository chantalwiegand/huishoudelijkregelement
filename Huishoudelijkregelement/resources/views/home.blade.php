@include('Bootstrap.bootstrap')
<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: black;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

        #myBtn:hover {
            background-color: #555;
        }
    </style>
</head>

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container">
    <ul class="list-group list-group-flush" style="padding-top: 5%">
    @foreach($artikel as $artikels)

        <a class="list-group-item" href="#{{$artikels->title}}">{{$artikels->title}}</a>
    @endforeach
    </ul>
    @foreach($artikel as $artikels)
        <a name="{{$artikels->title}}">
        <h1 style="padding-top: 5%">{{$artikels->title}}</h1>
        {!!  $artikels->description !!}
        </a>

        <form method="post" action="{{route('artikel.edit', [$artikels->id])}}">
            {{ csrf_field() }}
            @method('GET')
            <button type="submit" value="Edit" class="btn btn-outline-dark">Aanpassen</button>
        </form>
    @endforeach

</div>

<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

