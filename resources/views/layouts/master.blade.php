@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          @yield('content')
        </div>
        <!---Container Fluid-->
@include('layouts.footer')