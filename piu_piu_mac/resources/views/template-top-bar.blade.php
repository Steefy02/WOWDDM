<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <title>@yield('title')</title>


    <!--Eshopper shit-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/css/style2.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style3.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">

    @yield('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/045d1ece88.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid light-bg-color">
        <div class="row py-2 px-xl-5">
            <div class="col-lg-6 col-sm-6 d-block d-lg-block">
                <span>Magazinul WowDDM se afla in development!</span>
            </div>
            <div class="col-lg-6 col-sm-6 text-sm-right text-md-righ text-lg-right">
                <div class="align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/profile.php?id=100091510751869" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="https://instagram.com/wowddm_fashion_store?igshid=OGQ5ZDc2ODk2ZA==" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5" style="background-color: #110a29;">
            <div class="col-lg-3 d-none d-lg-block">
            </div>
            <div class="col-lg-6 text-center">
                <a href="{{route('home')}}" class="text-decoration-none">
                    <!--h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1-->
                    <img src="{{asset('/img/wowddm_logo2.jpg')}}" style="height: 120px;" />
                </a>
            </div>

            @guest
            <div class="col-lg-3 text-right align-self-end">
                <span class='nav-item nav-link'><a href="" class='text-on-dark-bg nav-link' data-toggle="modal" data-target="#login-button">Logare/Inregistrare</a></span>
            </div>
            
            @else

            <div class="col-lg-3 text-right align-self-end dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" style='padding-right: 3rem'>
                    <i class='fas fa-circle-user fa-fw' style='color: white'></i>
                    <span class="mr-2 d-none d-lg-inline text-gray-600" style='font-size: 1rem'>{{Auth::user()->name}}</span>
                </a>
                    <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" id='userinfo'>
                    <a class="dropdown-item" href="{{route('account')}}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil
                    </a>
                    <a class="dropdown-item" href="{{route('cart')}}">
                        <i class="fas fa-cart-shopping mr-2 text-gray-400"></i>
                        Cosul meu
                    </a>
                    <a class="dropdown-item" href="{{route('favorites')}}">
                        <i class="fas fa-heart fa-sm fa-fw mr-2 text-gray-400"></i>
                        Favorite
                    </a>
                    <div class="dropdown-divider"></div>
                    @if(Auth::user()->is_admin)
                    <a class='dropdown-item' href="https://wowddm.ro/admin">
                        <i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>
                        Admin
                    </a>
                    <div class='dropdown-divider'></div>
                    @endif
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Delogheaza-te
                    </a>
                </div>
                <!--<a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item nav-link text-on-dark-bg">Delogheaza-te</a> -->
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                @csrf
            </form>

            @endguest
        </div>
    </div>

    <div class='container-fluid' style='height: 5rem; background-color: rgb(220,220,250)'>
        <h6 style='text-align: center;padding-top: 1rem' class='robot'>@yield('section-title')</h6>
    </div>

    <div class="container" style="max-width: 1400px">@yield('top-bar-content')</div>

    <footer class="text-center text-lg-start text-muted bg-primary mt-3" style="background-color: #110a29!important;">
        <!-- Section: Links  -->
        <section class="">
          <div class="container text-center text-md-start pt-4 pb-4">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-12 col-lg-4 col-sm-12 mb-2">
                <!-- Content -->
                <a href="https://mdbootstrap.com/" target="_blank" class="text-white h2">
                  WowDDM
                </a>
                <p class="mt-1 text-white">
                  © 2023 Copyright: WowDDM.ro
                </p>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-6 col-sm-6 col-lg-4">
                <!-- Links -->
                <h6 class="text-uppercase text-white fw-bold mb-2">
                  Magazin
                </h6>
                <ul class="list-unstyled mb-4">
                    <li>Adresa email: office@wowddm.ro</li>
                    <li>Numar de telefon:</li>
                    <li>0747 988 237</li>
                  <li><a class="text-white-50" href="https://goo.gl/maps/41RWQNUpnTCY5XfZ6">Gaseste magazinul</a></li>
                </ul>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-6 col-sm-6 col-lg-4">
                <!-- Links -->
                <h6 class="text-uppercase text-white fw-bold mb-2">
                  Informatii utile
                </h6>
                <ul class="list-unstyled mb-4">
                  <li><a class="text-white-50" href="#">Contact suport clienti</a></li>
                  <li><a class="text-white-50" href="#">Informatii retur</a></li>
                  <li><a class="text-white-50" href="https://wowddm.ro/anpc">Informatii ANPC</a></li>
                </ul>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <!-- Section: Links  -->
      </footer>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>      
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @yield('scripts')

    <script>

        var userdd = document.getElementById('userinfo');

        document.getElementById('userDropdown').onclick = function() {
            if(userdd.style.display === 'none' || userdd.style.display === '') {
                userdd.style.display = 'block';
            }else {
                userdd.style.display = 'none';
            }
        }

    </script>

</body>

</html>