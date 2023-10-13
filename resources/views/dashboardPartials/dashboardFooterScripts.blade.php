 <!--   Core JS Files   -->
 {{-- <script src="{{ asset('dashboardAssets/js/core/popper.min.js') }}"></script> --}}
 <script src="{{ asset('dashboardAssets/js/core/bootstrap.min.js') }}"></script>
 <script src="{{ asset('dashboardAssets/js/plugins/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('dashboardAssets/js/plugins/smooth-scrollbar.min.js') }}"></script>


 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <script src="{{ asset('dashboardAssets/js/soft-ui-dashboard.min.js') }}"></script>
 {{-- <livewire:modals /> --}}
 @livewireScripts
