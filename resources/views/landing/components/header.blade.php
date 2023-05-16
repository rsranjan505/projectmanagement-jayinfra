<header id="header" class="header-two">
    <div class="site-navigation">
      <div class="container">
          <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="logo">
                      <a class="d-block" href="{{ route('home')}}">
                        <img loading="lazy" src="{{ asset('assets/images/logo.png')}}" alt="Jay Infra Projects">
                      </a>
                  </div><!-- logo end -->

                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div id="navbar-collapse" class="collapse navbar-collapse">
                      <ul class="nav navbar-nav ml-auto align-items-center">
                        <li class="nav-item active">
                            <a href="#" class="nav-link ">Home </a>

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link" >About Us </a>

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link ">Projects </a>

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link" >Services </a>

                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">News <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="news-left-sidebar.html">Gallery</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="header-get-a-quote">
                            <a class="btn btn-primary" href="{{route('login')}}">Login</a>
                        </li>
                      </ul>
                  </div>
                </nav>
            </div>
            <!--/ Col end -->
          </div>
          <!--/ Row end -->
      </div>
      <!--/ Container end -->

    </div>
    <!--/ Navigation end -->
  </header>
