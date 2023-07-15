 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">


                 <li>
                     <a href="{{ route('home') }}" class="waves-effect">
                         <i class="bx bx-home-circle"></i>
                         <span key="t-chat">Dashboard</span>
                     </a>
                 </li>
                 @if(Auth::user()->role == 'Admin')
                 <li>
                    <a href="{{ route('users.index') }}" class="waves-effect">
                        <i class='bx bx-user'></i>
                        <span key="t-chat">Users</span>
                    </a>
                </li>
                 <li>
                     <a href="{{ route('category.index') }}" class="waves-effect">
                         <i class='bx bx-user'></i>
                         <span key="t-chat">Category</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('product.index') }}" class="waves-effect">
                         <i class='bx bx-user'></i>
                         <span key="t-chat">Product</span>
                     </a>
                 </li>
                 @endif

                 
               



             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
 <!-- Left Sidebar End -->
 <div class="main-content">