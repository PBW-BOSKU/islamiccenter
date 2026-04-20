<footer class="admin-footer"></footer>

<script>
window.pengunjungData = <?= json_encode($pengunjung ?? []) ?>;
window.selectedTanggal = "<?= $tanggal ?? '' ?>";
</script>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="/assets/js/admin.js"></script>