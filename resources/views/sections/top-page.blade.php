<header style="padding-bottom:30%">
    <style>
        *{
            margin:0;
            padding:0;
        }

        body{
            background:#ccc;
            font-family: arial,verdana,tahoma;
        }
        /*
        Width of image : 500;
        Width of hovered image: 500
        Width of unhovered image: 25x;
        Width of container : 500 + 50*4 = 700px;
        Default 700/5 : 140px;
        */

        .accordian{
            width: 705px;
            height: 333px;
            overflow:hidden;

            margin: 100px auto;
            -webkit-box-shadow: 0 8px 6px -6px black;
            -moz-box-shadow: 0 8px 6px -6px black;
            box-shadow: 0px 8px 6px -6px black;
        }
        .accordian ul{

        }
        .accordian li{
            position: relative;
            display:block;
            width:140px;
            float: left;

            border-left: 1px solid #888;
            -webkit-box-shadow: 0 0 25px 10px rgba(0,0,0,0.5);
            -moz-box-shadow: 0 0 25px 10px rgba(0,0,0,0.5);

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }


        .accordian ul:hover li{
            width: 50px;
        }

        .accordian ul li:hover{
            width:500px;
        }

        .accordian li img{
            display: block;
        }

        .image_title{
            background: rgba(0,0,0,0.5);
            position:absolute;
            left:0;
            bottom:0;
            width:500px;
        }

        .image_title a{
            display: block;
            color: #fff;
            text-decoration: none;
            padding:20px;
            font-size:16px;
        }



    </style>

    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-content">
                    <div class="header-content-inner">
                        <div class="accordian">
                            <ul>
                                <li>
                                    <div class="image_title">
                                        <a href="#">Wedding 1</a>
                                    </div>
                                    <a href="#">
                                        <img src="http://farm3.staticflickr.com/2812/10121061143_e05f1619d7.jpg">
                                    </a>
                                </li>
                                <li>
                                    <div class="image_title">
                                        <a href="#">Wedding 2</a>
                                    </div>
                                    <a href="#">
                                        <img src="http://farm8.staticflickr.com/7435/10067483716_2b6a593ca8.jpg">
                                    </a>
                                </li>
                                <li>
                                    <div class="image_title">
                                        <a href="#">Wedding 3</a>
                                    </div>
                                    <a href="#">
                                        <img src="http://farm8.staticflickr.com/7310/10065811936_8debcccb71.jpg">
                                    </a>
                                </li>
                                <li>
                                    <div class="image_title">
                                        <a href="#">Wedding 4</a>
                                    </div>
                                    <a href="#">
                                        <img src="http://farm4.staticflickr.com/3715/10065692306_705364fa01.jpg">
                                    </a>
                                </li>
                                <li>
                                    <div class="image_title">
                                        <a href="#">Wedding 5</a>
                                    </div>
                                    <a href="#">
                                        <img src="http://farm4.staticflickr.com/3667/9759830873_7474bd9fc2.jpg">
                                    </a>
                                </li>
                            </ul>
                        </div>
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
    </div>
</header>