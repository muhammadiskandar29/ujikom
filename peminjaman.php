<?php
include 'koneksi.php';
include 'navbar.php';
?>

<h3>Data Peminjaman</h3>
<a href="pinjam_tambah.php" class="btn btn-primary btn-sm mb-3">+ Pinjam Buku</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Denda</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $sql = "SELECT peminjaman.*, anggota.nama, buku.judul 
                FROM peminjaman 
                JOIN anggota ON peminjaman.id_anggota = anggota.id 
                JOIN buku ON peminjaman.id_buku = buku.id 
                ORDER BY peminjaman.id DESC";
        $query = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['judul']; ?></td>
            <td><?php echo $data['tanggal_pinjam']; ?></td>
            <td><?php echo $data['jatuh_tempo']; ?></td>
            <td><?php echo $data['tanggal_kembali']; ?></td>
            <td><?php echo $data['status']; ?></td>
            <td>Rp <?php echo $data['denda']; ?></td>
            <td>
                <?php if ($data['status'] == 'Dipinjam') { ?>
                    <a href="pinjam_kembali.php?id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</a>
                <?php } else { ?>
                    Selesai
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</body>
</html>
