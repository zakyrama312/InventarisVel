<script src="{{ asset('/')}}assets/libs/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('/')}}assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/')}}assets/js/sidebarmenu.js"></script>
<script src="{{ asset('/')}}assets/js/app.min.js"></script>
<script src="{{ asset('/')}}assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="{{ asset('/')}}assets/libs/simplebar/dist/simplebar.js"></script>
<script src="{{ asset('/')}}assets/js/dashboard.js"></script>
<script src="{{ asset('/')}}assets/datatables/datatables.min.js"></script>

<!-- DataTables Buttons -->
<script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>

<!-- JSZip for Excel Export -->
<script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


<!-- PDFMake for PDF Export -->
<script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/pdfmake-00.2.7/pdfmake.min.js"></script>
<script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/pdfmake-00.2.7/vfs_fonts.js"></script>

<!-- DataTables HTML5 Buttons -->
<script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/buttons.html5.min.js"></script>

<!-- DataTables Print Button -->
<script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/buttons.print.min.js"></script>

{{-- search --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}

<script src="{{ asset('/') }}assets/select2/select2.min.js"></script>
<script>
    document.getElementById("sidebarToggle").addEventListener("click", function() {
        document.body.classList.toggle("sidebar-collapsed");
    });
</script>

<script>
    $("#country").select2({
        placeholder: "Select Country",
        allowClear: true
    });

    $('#modalCreate').on('shown.bs.modal', function() {
        $('#country').select2({
            dropdownParent: $('#modalCreate') // Set parent dropdown ke modal
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabeldata').DataTable({
            // dom: 'Bfrtip',

        });
    });
</script>

<script>
    document.querySelectorAll('.sidebar-link').forEach(function(link) {
        link.addEventListener('click', function() {
            // Toggle kelas 'open' pada klik
            this.classList.toggle('open');
        });
    });
</script>

<script src="{{ asset('assets/js/myscript.js') }}"></script>

<script>
    const dropdownSelect = document.querySelector('.dropdown-select');
    const dropdownList = document.getElementById('dropdownList');

    dropdownSelect.addEventListener('focus', () => {
        dropdownList.style.display = 'block';
    });

    dropdownSelect.addEventListener('blur', () => {
        setTimeout(() => {
            dropdownList.style.display = 'none';
        }, 200);
    });

    dropdownList.addEventListener('mousedown', (e) => {
        e.preventDefault();
        const selectedOption = e.target.textContent;
        dropdownSelect.value = selectedOption;
        dropdownList.style.display = 'none';
    });

    function filterFunction() {
        const filter = dropdownSelect.value.toLowerCase();
        const divs = dropdownList.getElementsByTagName('div');

        for (let i = 0; i < divs.length; i++) {
            const txtValue = divs[i].textContent || divs[i].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                divs[i].style.display = "";
            } else {
                divs[i].style.display = "none";
            }
        }
    }
</script>

<script>
    window.userRole = "{{ auth()->user()->role }}";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
@stack('scripts')

</body>

</html>