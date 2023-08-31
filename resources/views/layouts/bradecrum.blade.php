     @extends('layouts.parent')
     @section('contant')
         <!-- breadcrumb-section -->
         <div class="breadcrumb-section breadcrumb-bg">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-8 offset-lg-2 text-center">
                         <div class="breadcrumb-text">
                             <p>@yield('desc')</p>
                             <h1>@yield('title')</h1>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         @yield('contant2')
         <!-- end breadcrumb section -->
     @endsection
