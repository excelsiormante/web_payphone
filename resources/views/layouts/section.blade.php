 <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

            @include('tabs.dialer')
  
        </div>
   
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                
                @yield('content');

            </div>
        </div>
        <!-- /#page-content-wrapper -->

</div>
    <!-- /#wrapper -->