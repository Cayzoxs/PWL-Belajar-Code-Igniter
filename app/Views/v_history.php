<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
History Transaksi Pembelian <strong><?= $username ?></strong>
<hr>
<div class="table-responsive">
    <!-- Table with stripped rows -->
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Pembelian</th>
                <th scope="col">Waktu Pembelian</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Alamat</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($transactions)) :
                foreach ($transactions as $index => $item) :
            ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['created_at'] ?></td>
                        <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?= $item['alamat'] ?></td>
                        <td>
                            <?= ($item['status'] == "1")
                                ? '<span class="badge bg-success">Sudah Selesai</span>'
                                : '<span class="badge bg-warning">Belum Selesai</span>' ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                Detail
                            </button>
                        </td>
                    </tr> 
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
</div>

<?php if (!empty($transactions)) : ?>
    <?php foreach ($transactions as $item) : ?>
        <!-- Detail Modal Begin -->
        <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Transaksi #<?= $item['id'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> 
                        <?php if (!empty($products[$item['id']])) : ?>
                            <?php foreach ($products[$item['id']] as $index2 => $item2) : ?>
                                <?= $index2 + 1 . ")" ?>
                                
                                <?php
                                $imagePath = FCPATH . 'img/' . $item2['foto'];

                                if (!empty($item2['foto']) && file_exists($imagePath)) :
                                ?>
                                    <div class="my-2">
                                        <img src="<?= base_url('img/' . $item2['foto']) ?>" width="100" class="img-thumbnail">
                                    </div>
                                <?php endif; ?>

                                <strong><?= $item2['nama'] ?></strong>
                                <?= number_to_currency($item2['harga'], 'IDR') ?>
                                <br>
                                <?= "(" . $item2['jumlah'] . " pcs)" ?><br>
                                <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                <hr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <hr>
                        <?php
                        // Kalkulasi otomatis
                        $ongkir = $item['ongkir'];
                        $diskon = isset($item['diskon']) ? $item['diskon'] : 0; 
                        $total_pembayaran = $item['total_harga'];

                        $harga_setelah_diskon = $total_pembayaran - $ongkir;
                        $harga_asli = $harga_setelah_diskon + $diskon;
                        ?>

                        <div class="row justify-content-end">
                            <div class="col-12">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td>Harga Asli</td>
                                        <td class="text-end"><?= number_to_currency($harga_asli, 'IDR') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Diskon Promo</td>
                                        <td class="text-end text-danger">- <?= number_to_currency($diskon, 'IDR') ?></td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="pb-2">Harga Setelah Diskon</td>
                                        <td class="text-end pb-2"><?= number_to_currency($harga_setelah_diskon, 'IDR') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pt-2">Ongkos Kirim</td>
                                        <td class="text-end pt-2"><?= number_to_currency($ongkir, 'IDR') ?></td>
                                    </tr>
                                    <tr class="border-top border-dark">
                                        <td class="pt-2"><strong>Total Pembayaran</strong></td>
                                        <td class="text-end pt-2"><strong class="fs-6 text-primary"><?= number_to_currency($total_pembayaran, 'IDR') ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
        <!-- Detail Modal End -->
    <?php endforeach; ?>
<?php endif; ?>
<?= $this->endSection() ?>