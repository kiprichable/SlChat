<header style="padding-bottom:30%"; >
    <style>
        .carousel-inner  img{
            background: url(../img/bg-pattern.png), linear-gradient(to left, #078297, #2d96dc);
            width:80%;
            height:50%;
            margin:10%;
        }
    </style>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        {{--<ol class="carousel-indicators">--}}
            {{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
            {{--<li data-target="#myCarousel" data-slide-to="1"></li>--}}
            {{--<li data-target="#myCarousel" data-slide-to="2"></li>--}}
        {{--</ol>--}}

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="{{URL::Asset('img/CES_poster_bench.png')}}" alt="">
            </div>

            <div class="item">
                <img src="{{URL::Asset('img/CES_poster_teens.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{URL::Asset('img/CES_poster_shoes.png')}}" alt="">
            </div>

            <div class="item">

            </div>
        </div>

        <!-- Left and right controls -->
        {{--<a class="left carousel-control" href="#myCarousel" data-slide="prev">--}}
            {{--<span class="glyphicon glyphicon-chevron-left"></span>--}}
            {{--<span class="sr-only">Previous</span>--}}
        {{--</a>--}}
        {{--<a class="right carousel-control" href="#myCarousel" data-slide="next">--}}
            {{--<span class="glyphicon glyphicon-chevron-right"></span>--}}
            {{--<span class="sr-only">Next</span>--}}
        {{--</a>--}}
    </div>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-sm-7">
            <div class="header-content">
                <div class="header-content-inner">
                    <p>Coordinated Entry System offers an organized, efficient approach to providing
                        homeless families with services and housing by linking them to programs and matching
                        families' needs to providers' strengths and capacity.</br> To achieve this CES has
                        designed a mobile app that helps families and individuals request housing from the palm
                        of their hands.

                    </p>
                    <a href="https://txthomeless.com/CES/www/#/tab/prescreen" class="btn btn-outline
                        btn-xl page-scroll">CES Pre Screen</a>
                </div>
            </div>
        </div>
        <div class="col-sm-5" style>
            <div class="device-container">
                <div class="device-mockup iphone6_plus portrait white">
                    <div class="device">
                        <div class="screen">
                            <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                            <img src="img/demo.png" class="img-responsive" alt="">
                        </div>
                        <div class="button">
                            <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>