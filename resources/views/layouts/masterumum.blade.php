<!doctype html>
<html lang="en">

<head>
    <title>Inventory ATK</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/siger_crop-removebg-preview.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/siger_crop-removebg-preview.png')}}">
    {{-- TIME PICKER --}}
    <link rel="stylesheet" href="{{asset('bootstrap-datetimepicker.min.css')}}">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        @include('layouts.includes._navbarumum')
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        @include('layouts.includes._sidebarumum')
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">Made by <i class="fa fa-love"></i><a
                        href="#" data-toggle="modal" data-target="#kopibranti">sampurno</a>
                </p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->

    {{-- Modal kopibranti --}}
<div class="modal fade" id="kopibranti" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>TKG Transformaction</h3>
            </div>
            <div class="modal-body text-center">
                <img id="previewgambar" src="{{asset('images/Kopi Branti.png')}}" class="rounded" style="max-width: 550px; max-height: 400px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal kopibranti --}}
    
    <!-- Javascript -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <script src="{{asset('moment-with-locales.min.js')}}"></script>
    <script src="{{asset('bootstrap-datetimepicker.min.js')}}"></script>

    <script>
        $('#modalgambar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('nama') // Extract info from data-* attributes
            var recipient2 = button.data('image')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#NamaBarang').text(recipient)
            modal.find('#previewgambar').attr("src", recipient2)
        })

        $('#editmodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('namabarang') // Extract info from data-* attributes
            var recipient2 = button.data('id')
            var recipient3 = button.data('kodebarang')
            var recipient4 = button.data('gambar')
            var aksi = "/barangga/" + recipient2 + "/update"
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#namabarang').attr("value", recipient)
            modal.find('#kodebarang').attr("value", recipient3)
            modal.find('#gambar').attr("value", recipient4)
            modal.find('#aksi').attr("action", aksi)
        })

        $('#editmodalbarangmasuk').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('barangga_id') // Extract info from data-* attributes
            var recipient2 = button.data('id')
            var recipient3 = button.data('tanggalmasuk')
            var recipient4 = button.data('jumlahmasuk')
            var aksi = "/masukga/" + recipient2 + "/update"
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#barangga_id').attr("value", recipient)
            modal.find('#tanggalmasuk').attr("value", recipient3)
            modal.find('#jumlahmasuk').attr("value", recipient4)
            modal.find('#aksi').attr("action", aksi)
        })

        $(function(){
            $('#tanggalmasuk').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalkeluar').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalawal').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalakhir').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalawalmasuk').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalakhirmasuk').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalawalkeluar').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalakhirkeluar').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalbaawal').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalbaakhir').datetimepicker({
                locale: 'id',
                format: 'YYYY/MM/DD'
            });
        });

        $(function(){
            $('#tanggalba').datetimepicker({
                locale: 'id',
                format: 'DD MMMM YYYY'
            });
        });

        $(function(){
            var current = location.pathname;
            $('.nav li a').each(function(){
                var $this = $(this);
                // if the current path is like this link, make it active
                if($this.attr('href').indexOf(current) !== -1){
                    $this.addClass('active');
                }
            })
        })
    </script>
{{-- END JAVASCRIPT --}}
</body>

</html>