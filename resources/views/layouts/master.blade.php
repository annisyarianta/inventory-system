<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>ATK Inventory System</title>
        <!-- VENDOR CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}"> --}}
        <link
			href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
			rel="stylesheet"
			type="text/css" />
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}"> --}}
        <!-- MAIN CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"> --}}
        <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"> --}}
        <!-- GOOGLE FONTS -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> --}}
        <link
			href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
			rel="stylesheet" />
        <!-- ICONS -->
        {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/siger_crop-removebg-preview.png') }}"> --}}
        <link rel="icon" type="image/png" sizes="96x96"
            href="{{ asset('assets/img/siger_crop-removebg-preview.png') }}">
        {{-- TIME PICKER --}}
        <link rel="stylesheet" href="{{ asset('bootstrap-datetimepicker.min.css') }}">
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
		<div id="wrapper">
			<!-- Sidebar -->
			@include('layouts.includes._sidebar')
			<!-- End of Sidebar -->
			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">
				<!-- Main Content -->
				<div id="content">
					<!-- Topbar -->
					@include('layouts.includes._navbar')
					<!-- End of Topbar -->

						@yield('content')

						<!-- Content Row -->
						
					<!-- /.container-fluid -->
				</div>
				<!-- End of Main Content -->

				<!-- Footer -->
				<footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; PT Angkasa Pura II 2024</span>
                        </div>
                    </div>
                </footer>
				<!-- End of Footer -->
			</div>
			<!-- End of Content Wrapper -->
		</div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
        <script src="{{ asset('moment-with-locales.min.js') }}"></script>
        <script src="{{ asset('bootstrap-datetimepicker.min.js') }}"></script> --}}
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

        <script>
            $('#modalgambar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('nama') // Extract info from data-* attributes
                var recipient2 = button.data('image')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('#NamaBarang').text(recipient)
                modal.find('#previewgambar').attr("src", recipient2)
            })

            $('#editmodal').on('show.bs.modal', function(event) {
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

            $('#editmodalbarangmasuk').on('show.bs.modal', function(event) {
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

            $('#editunit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('namaunit') // Extract info from data-* attributes
                var recipient2 = button.data('id')
                var aksi = "/unit/" + recipient2 + "/update"
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('#namaunit').attr("value", recipient)
                modal.find('#aksi').attr("action", aksi)
            })

            $(function() {
                $('#tanggalmasuk').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalkeluar').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalawal').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalakhir').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalawalmasuk').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalakhirmasuk').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalawalkeluar').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalakhirkeluar').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalbaawal').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalbaakhir').datetimepicker({
                    locale: 'id',
                    format: 'YYYY/MM/DD'
                });
            });

            $(function() {
                $('#tanggalba').datetimepicker({
                    locale: 'id',
                    format: 'DD MMMM YYYY'
                });
            });

            $(function() {
                var current = location.pathname;
                $('.nav-link').each(function() {
                    var $this = $(this);
                    // if the current path is like this link, make it active
                    if ($this.attr('href') === current) {
                        $this.addClass('active');
                    }
                })
            })

            $(function() {
                var current = location.pathname;
                $('.collapse-item').each(function() {
                    var $this = $(this);
                    // if the current path is like this link, make it active
                    if ($this.attr('href') === current) {
                        $this.addClass('active');
                    }
                })
            })
        </script>
        {{-- END JAVASCRIPT --}}
    </body>

</html>