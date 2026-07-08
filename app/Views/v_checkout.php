<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>

        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga']) ?>

        <div class="col-12">
            <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'nama',
                'id'       => 'nama',
                'class'    => 'form-control',
                'value'    => session()->get('username'),
                'readonly' => true]) ?>
        </div>
        <div class="col-12">
            <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
            <?= form_input(['name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control']) ?>
        </div> 
        <div class="col-12"> 
            <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
            <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>
        </div>
        <div class="col-12"> 
            <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?> 
            <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-select']) ?>
        </div>
        <div class="col-12">
            <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'ongkir',
                'id'       => 'ongkir',
                'class'    => 'form-control',
                'readonly' => true]) ?>
        </div>
        
        <div class="col-12 mt-3">
            <?= form_label('Kode Voucher', 'voucher_code', ['class' => 'form-label']) ?>
            <input type="text" name="voucher_code" id="voucher_code" class="form-control" placeholder="Promo2026">
            <small class="text-muted">Tersedia: PROMO2025 (10%), PROMO2026 (15%), AKHIRTAHUN (25%)</small>
        </div>

        <div class="col-12 mt-4">
            <?= form_submit('submit', 'Buat Pesanan', ['class' => 'btn btn-primary w-100']) ?>
        </div>
        
        <?= form_close() ?> 
    </div>

    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($items)) :
                    foreach ($items as $index => $item) :
                ?>
                        <tr>
                            <td><?= $item['name'] ?></td>
                            <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
                
                <tr>
                    <td colspan="2"></td>
                    <td>Subtotal Asli</td>
                    <td><?= number_to_currency($total, 'IDR') ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-danger">Diskon Voucher</td>
                    <td class="text-danger">-IDR <span id="tampil_diskon_voucher">0</span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Biaya Jasa</td>
                    <td>IDR <span id="tampil_biaya_jasa"><?= number_format($biaya_jasa, 0, ',', '.') ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-success">Free Mouse</td>
                    <td class="text-success">-IDR <span id="tampil_free_mouse"><?= number_format($free_mouse, 0, ',', '.') ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><strong>Subtotal Promo</strong></td>
                    <?php $subtotal_awal = $total + $biaya_jasa - $free_mouse; ?>
                    <td><strong>IDR <span id="tampil_subtotal_baru"><?= number_format($subtotal_awal, 0, ',', '.') ?></span></strong></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Ongkir</td>
                    <td><span id="tampil_ongkir">IDR 0</span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><strong>Grand Total</strong></td>
                    <td><strong><span id="total"><?= number_format($subtotal_awal, 0, ',', '.') ?></span></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>  
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    let ongkir = 0;
    let subtotal_baru = <?= $total + $biaya_jasa - $free_mouse ?>; 

    function updateGrandTotal() {
        let grand_total = subtotal_baru + ongkir;

        $("#ongkir").val(ongkir);
        $("#tampil_ongkir").text(`IDR ${ongkir.toLocaleString('id-ID')}`); 
        $("#total").text(`IDR ${grand_total.toLocaleString('id-ID')}`);
        $("#total_harga").val(grand_total);
    }

    $('#kelurahan').select2({
        placeholder: 'Cari daerah tujuan',
        minimumInputLength: 3, 
        ajax: {
            url: '<?= site_url('ajax/destinations') ?>',
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });

    $("#kelurahan").on('change', function () {
        let id_kelurahan = $(this).val();
        $("#layanan").empty();
        ongkir = 0;
        updateGrandTotal(); 

        $.ajax({
            url: "<?= site_url('ajax/costs') ?>", 
            dataType: "json",
            data: { destination: id_kelurahan },
            success: function (data) { 
                data.forEach(function (item) {
                    $("#layanan").append(
                        $('<option>', {
                            value: item.cost,
                            text: `${item.description} (${item.service}) : estimasi ${item.etd}`
                        })
                    );
                });
            }
        });
    });

    $("#layanan").on('change', function() {
        ongkir = parseInt($(this).val());
        updateGrandTotal();
    }); 

    $("#voucher_code").on('keyup', function() {
        hitungPromo();
    });

    function hitungPromo() {
        let voucher = $("#voucher_code").val();
        
        $.ajax({
            url: "<?= site_url('ajax/hitung_promo') ?>",
            type: "POST",
            data: { voucher_code: voucher },
            dataType: "json",
            success: function(res) {
                $("#tampil_biaya_jasa").text(res.biaya_jasa.toLocaleString('id-ID'));
                $("#tampil_diskon_voucher").text(res.diskon_voucher.toLocaleString('id-ID'));
                $("#tampil_free_mouse").text(res.free_mouse.toLocaleString('id-ID'));
                $("#tampil_subtotal_baru").text(res.subtotal_baru.toLocaleString('id-ID'));
                
                subtotal_baru = res.subtotal_baru;
                updateGrandTotal();
            }
        });
    }

    updateGrandTotal();
});
</script>
<?= $this->endSection() ?>