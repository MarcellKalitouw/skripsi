    
   
    <script src="{{asset ('../template/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset ('../template/src/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset ('../template/src/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->

    <script src="{{ asset('../select2/dist/js/select2.min.js') }}"></script>


    

    <!-- apps -->
    <script src="{{asset ('../template/src/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{asset ('../template/src/dist/js/feather.min.js')}}"></script>
    <script src="{{asset ('../template/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset ('../template/src/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset ('../template/src/dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    
    <script src="{{asset ('/template/src/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset ('/template/src/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    <!--Morris JavaScript -->
    <script src="{{asset ('/template/src/assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{asset ('/template/src/assets/libs/morris.js/morris.min.js') }}"></script>
    {{-- <script src="{{asset ('/template/src/dist/js/pages/morris/morris-data.js') }}"></script> --}}
    {{-- <script src="{{asset ('/template/src/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset ('/template/src/assets/extra-libs/c3/c3.min.js')}}"></script> --}}
    {{-- <script src="{{asset ('/template/src/assets/libs/chartist/dist/chartist.min.js')}}"></script> --}}
    {{-- <script src="{{asset ('/template/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script> --}}
    {{-- <script src="{{asset ('/template/src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset ('/template/src/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
    {{-- <script src="{{asset ('/template/src/dist/js/pages/dashboards/dashboard1.min.js')}}"></script> --}}

    @stack('dashboard')