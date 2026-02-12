{{-- ================= CORE JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script> --}}
<script src="{{ asset('assets/js/bootstrap-4-3.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-kit/1.1.3/sticky-kit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="{{ asset('assets/etc/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/etc/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/etc/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/etc/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>

<script src="{{ asset('assets/etc/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

<script src="{{ asset('assets/etc/cleave.js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/etc/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>

<script src="{{ asset('assets/etc/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('assets/etc/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/etc/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/etc/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset('assets/etc/select2/dist/js/select2.full.min.js') }}"></script>



<script src="{{ asset('assets/toastify/toastify.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert.js') }}"></script>

{{-- <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script> --}}
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
{{-- <script src="{{ asset('assets/js/page/index-0.js') }}"></script> --}}




<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 5000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4CAF50",
            }).showToast();
        @endif

        @if (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF5252",
            }).showToast();
        @endif
    });
</script>

<script>
    $(document).ready(function() {
        $(".main-sidebar-toggle").click(function(e) {
            e.preventDefault();
            $("body").toggleClass("sidebar-gone");
        });
    });
</script>
