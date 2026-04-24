<?php
class ReviewModel {

    private $conn;

    public function __construct() {
        require __DIR__ . '/../../config/koneksi.php';
        $this->conn = $conn;
    }

    /* ================= GET ALL ================= */
    public function getAll() {

        $query = $this->conn->query("
            SELECT * FROM review ORDER BY id DESC
        ");

        if (!$query) {
            error_log("DB ERROR (getAll): " . $this->conn->error);
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }


    /* ================= TAMBAH ================= */
    public function tambah($data) {

        $nama = trim($data['nama'] ?? '');
        $komentar = trim($data['komentar'] ?? '');
        $rating = (int)($data['rating'] ?? 0);

        // VALIDASI DASAR (fail-safe)
        if (!$nama || !$komentar || $rating < 1 || $rating > 5) {
            return false;
        }

        $stmt = $this->conn->prepare("
            INSERT INTO review (nama, komentar, rating)
            VALUES (?, ?, ?)
        ");

        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("ssi", $nama, $komentar, $rating);

        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }

        $id = $this->conn->insert_id;

        $stmt->close();

        return $id;
    }

/* ================= HAPUS BY ID ================= */
        public function deleteById($id) {

            $id = (int)$id;

            if ($id <= 0) {
                return false;
            }

            $stmt = $this->conn->prepare("
                DELETE FROM review WHERE id = ?
            ");

            if (!$stmt) {
                error_log("Prepare failed (deleteById): " . $this->conn->error);
                return false;
            }

            $stmt->bind_param("i", $id);

            if (!$stmt->execute()) {
                error_log("Execute failed (deleteById): " . $stmt->error);
                return false;
            }

            $affected = $stmt->affected_rows;
            $stmt->close();

            // Kembalikan true jika ada baris yang terhapus
            return $affected > 0;
        }
}