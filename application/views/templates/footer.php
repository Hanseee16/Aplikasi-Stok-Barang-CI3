</div>
</div>

<script src="<?= base_url('assets/static/js/components/dark.js'); ?>"></script>
<script src="<?= base_url('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>
<script src="<?= base_url('assets/compiled/js/app.js'); ?>"></script>
<script src="<?= base_url('assets/extensions/apexcharts/apexcharts.min.js'); ?>"></script>
<script src="<?= base_url('assets/static/js/pages/dashboard.js'); ?>"></script>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/extensions/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js'); ?>"></script>
<script src="<?= base_url('assets/static/js/pages/datatables.js'); ?>"></script>
<script src="<?= base_url('assets/extensions/sweetalert2/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('assets/static/js/pages/sweetalert2.js'); ?>"></script>

<!-- SWEET ALERT -->
<script>
    function hapusData(url) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus?',
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak, batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function keluar(url) {
        Swal.fire({
            title: 'Anda yakin ingin keluar?',
            text: "Setelah keluar, Anda harus masuk kembali untuk mengakses akun Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Tidak, tetap di sini',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

</body>

</html>