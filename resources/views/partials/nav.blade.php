
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color:steelblue">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">HOME</a>
            <a class="navbar-brand page-scroll" href="https://txthomeless.com/CES/www/#/tab/home">PRE SCREEN</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="page-scroll" href="#COC">COC</a>
                </li>

                <li>
                    <a class="page-scroll" href="#headingHome">HEADING HOME</a>
                </li>


                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">CES ADMIN</a></li>
                    {{--<li><a href="{{ url('/users/create') }}">REGISTER</a></li>--}}

                @else
                    @if(Auth::user()['role_id'] <= 2)
                        <li><a href="{{ url('/admin/appointments') }}">APPOINTMENTS</a></li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#" onclick="$('#logout').submit();">
                                    <i class="fa fa-arrow-left"></i>
                                    <span class="title">LOG OUT</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li>
                    <a class="page-scroll" href="{{URL::ASSET('BYLAWS.docx')}}">BYLAWS DOC</a>
                </li>

                <li>
                    <a class="page-scroll" href="https://www.stlouiscountymn.gov/ADULT-FAMILIES/Community-Services/Homelessness/Continuum-of-Care-on-Homelessness">ST. LOUIS COUNTY</a>
                </li>
            </ul>
        </div>

        {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
        <button type="submit">@lang('quickadmin.logout')</button>
        {!! Form::close() !!}
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>