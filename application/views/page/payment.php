<html>
    <head>
    <script type="text/javascript"
    src="https://app.midtrans.com/snap/snap.js"
    data-client-key="Mid-client-KoICJaU9jpSylJ5G"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>
    <body>
        <form id="pay-create"  method="POST">
        <div class="wrapper">
            <div class="core">
                <?php if($this->cart->total_items() > 0){ ?>
                <div class="products">
                    <table class="table">
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Ket</th>
                            <th>Harga</th>
                        </tr>
                        <?php foreach($this->cart->contents() as $item): ?>
                        <tr>
                            <td># <?= $item['name']; ?></td>
                            <td class="text-center"><?= $item['qty']; ?></td>
                            <?php if($item['ket'] == ""){ ?>
                                <td>-</td>
                            <?php }else{ ?>
                                <td><?= $item['ket']; ?></td>
                            <?php } ?>
                            <td>Rp<?= number_format($item['subtotal'],0,",","."); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="line"></div>
                            <?php 
                                $invoice = $this->db->get_where('invoice', ['invoice_code' => $this->input->get('invoice')])->row_array();
                            ?>
                <div class="address">
                    <h2 class="title">Alamat Pengiriman</h2>
                    <hr>
                    <div class="form-group">
                        <label for="paymentSelectProvinces">Provinsi</label><br>
    
                        <select style="display: block; width: 100%;" name="paymentSelectProvinces" id="paymentSelectProvinces" class="form-control" required>
                            
                                <option></option>
                                <?php foreach ($provinces as $p) : ?>
                                    <option value="<?= $p['province_id']; ?>"><?= $p['province']; ?></option>
                                <?php endforeach; ?>
                            
                        </select>
                    </div>

                    <?php if($setting['ongkir'] == 0){ ?>
                    <div class="form-group">
                        <label for="paymentSelectRegenciesOngkir">Kota/Kabupaten</label><br>
                        <select style="display: block;width: 100%" name="paymentSelectRegenciesOngkir" id="paymentSelectRegenciesOngkir" class="form-control" required>
                            <option></option>
                        </select>
                    </div>
                    <?php }else{ ?>
                        <div class="form-group">
                            <h1 style="display: none;" id="regency-id"><?php echo $invoice['regency']; ?></h1>
                            
                                <label for="paymentSelectRegencies">Kota/Kabupaten</label><br>
                                <select style="display: block;width: 100%" name="paymentSelectRegencies" id="paymentSelectRegencies" class="form-control" required>
                                    <option></option>
                                </select>
                            
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="district">Kecamatan</label>
                        <?php if ($invoice['district'] == null) { ?>
                        <input type="text" class="form-control" autocomplete="off" id="district" name="district" placeholder="Nama Kecamatan" required>
                        <?php }else{ ?>
                        <input type="text" class="form-control" autocomplete="off" id="district" name="district" placeholder="Nama Kecamatan" value="<?= $invoice['district']; ?>" required>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="village">Desa/Kelurahan</label>
                        <?php if ($invoice['village'] == null) { ?>
                        <input type="text" class="form-control" autocomplete="off" id="village" name="village" placeholder="Nama Desa/Kelurahan" required>
                        <?php }else{ ?>
                        <input type="text" class="form-control" autocomplete="off" id="village" name="village" placeholder="Nama Desa/Kelurahan" value="<?= $invoice['village']; ?>" required>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat Lengkap</label>
                        <?php if ($invoice['address'] == null) { ?>
                        <input type="text" class="form-control" autocomplete="off" id="address" name="address" placeholder="Alamat Jalan / No. RT RW / No. Rumah" required>
                        <?php }else{ ?>
                        <input type="text" class="form-control" autocomplete="off" id="address" name="address" placeholder="Alamat Jalan / No. RT RW / No. Rumah" value="<?= $invoice['address']; ?>" required>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Kode Pos</label>
                        <?php if ($invoice['zipcode'] == null) { ?>
                        <input type="number" class="form-control" autocomplete="off" id="zipcode" name="zipcode" placeholder="Kode Pos" required>
                        <?php }else{ ?>
                        <input type="number" class="form-control" autocomplete="off" id="zipcode" name="zipcode" placeholder="Kode Pos" value="<?= $invoice['zipcode']; ?>" required>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <?php if ($invoice['name'] == null) { ?>
                        <input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="Nama Penerima" required>
                        <?php }else{ ?>
                        <input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="Nama Penerima" value="<?= $invoice['name']; ?>" required>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="telp">Nomor Telepon</label>
                        <?php if ($invoice['telp'] == null) { ?>
                        <input type="number" class="form-control" autocomplete="off" id="telp" name="telp" placeholder="No Telp. / WA" required>
                        <?php }else{ ?>
                        <input type="number" class="form-control" autocomplete="off" id="telp" name="telp" placeholder="No Telp. / WA" value="<?= $invoice['telp']; ?>" required>
                        <?php } ?>
                    </div>
        
                    <?php if($setting['ongkir'] != 0){ ?>
                    <div class="line mt-4"></div>
                    <div class="send">
                        <h2 class="title">Metode Pengiriman</h2>
                        <small class="text-danger" id="paymentTextNotSupportDelivery" style="display: none;">Metode antar belum tersedia untuk tempat Anda.</small>
                        <div class="form-group mt-3" id="groupPaymentSelectKurir">
                            <select name="paymentSelectKurir" id="paymentSelectKurir" class="form-control" required>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php }else{ ?>
                    <div class="alert alert-warning">Upss. Kamu belum memiliki satupun belanjaan. Yuk belanja dulu.</div>
                <?php } ?>
            </div>
            <div class="total shadow">
                <h2 class="title">Ringkasan Belanja</h2>
                <hr>
                <div class="list">
                    <p>Total Belanja</p>
                    <?php if($invoice['total_price'] == null){ ?>
                    <p>Rp<?= number_format($this->cart->total(),0,",","."); ?></p>
                    <?php }else{ ?> 
                    <p>Rp<?= number_format($invoice['total_price'],0,",","."); ?></p>
                    <?php } ?>
                </div>
                <?php if($setting['ongkir'] == 0){ ?>
                    <div class="list">
                    <p>Biaya Pengiriman</p>
                    <p id="paymentSendingPriceOngkir">Rp0</p>
                    </div>
                    <hr>
                    <div class="list">
                        <p>Total Tagihan</p>
                        <p id="paymentTotalAll">Rp<?= number_format($setting['default_ongkir'] + $this->cart->total(),0,",","."); ?></p>
                    </div>
                <?php }else{ ?>
                    <div class="list">
                        <p>Biaya Pengiriman</p>
                        <?php if($invoice['ongkir'] == null){ ?>
                        <p id="paymentSendingPrice">Rp0</p>
                        <?php }else{ ?>
                        <p id="paymentSendingPrice">Rp<?= number_format($invoice['ongkir'],0,",","."); ?></p>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="list">
                        <p>Total Tagihan</p>
                        <?php if($invoice['total_all'] == null){ ?>
                        <p id="paymentTotalAll">Rp<?= number_format($this->cart->total(),0,",","."); ?></p>
                        <?php }else{ ?>
                        <p id="paymentTotalAll">Rp<?= number_format($invoice['total_all'],0,",","."); ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if($this->cart->total_items() > 0){ ?>
                    <button class="btn rounded-pill btn-dark btn-block mt-2" type="submit" id="pay-button">Pay!</button>
                <?php }else{ ?>
                    <div class="alert mt-2 alert-warning">Keranjangmu masih kosong.</div>
                    <a href="<?= base_url(); ?>">
                        <button class="btn rounded-pill btn-dark btn-block mt-2">Belanja Dulu</button>
                    </a>
                <?php } ?>
            </div>
            <form id="payment-form" method="post" action="<?=base_url()?>/snap/finish">
                <input type="hidden" name="result_type" id="result-type" value=""></div>
                <input type="hidden" name="result_data" id="result-data" value=""></div>
            </form>
            <form id="transaction-success" method="post"></form>
        </div>
        </form>

<script type="text/javascript">
    const regencyId = document.getElementById('regency-id').innerHTML;
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    const invoice = url.searchParams.get("invoice");
	const transactionSuccess = document.getElementById('transaction-success');

    $('#pay-button').click(function (event) {
        if (checkRequiredFields()) {
            if(invoice == null) {
                $("#pay-create").attr("action", "<?=base_url()?>payment/succesfully");    
            }else {
                $("#pay-create").attr("action", "<?=base_url()?>payment/succesfully?invoice=" + invoice);
            }
            $("#pay-create").submit();
        }else {
            alert('Mohon lengkapi data pengiriman terlebih dahulu.');
        }
    });

    $(document).ready(function() {
        if (invoice !== null) {
            $.ajax({
                url: '<?=base_url()?>snap/token?invoice=' + invoice,
                cache: false,
                success: function(data) {
                    console.log('token = '+data);
                    snap.pay(data, {
                        onSuccess: function(result){
                            console.log('success');
                            console.log(result);
                            $("#transaction-success").attr("action", "<?= base_url(); ?>payment/transactionSuccess?invoice=" + invoice);
                            $("#transaction-success").submit();
                            $("#payment-form").submit();
                        },
                        onPending: function(result){
                            console.log('pending');
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onError: function(result){
                            console.log('error');
                            console.log(result);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        }
    });

  function checkRequiredFields() {
    var provincesSelect = document.getElementById('paymentSelectProvinces');
    var regenciesSelect = document.getElementById('paymentSelectRegencies');
    var districtInput = document.getElementById('district');
    var villageInput = document.getElementById('village');
    var addressInput = document.getElementById('address');
    var zipcodeInput = document.getElementById('zipcode');
    var nameInput = document.getElementById('name');
    var telpInput = document.getElementById('telp');
    var paymentSelectKurir = document.getElementById('paymentSelectKurir');

    if (
        provincesSelect.value !== '' &&
        regenciesSelect.value !== '' &&
        districtInput.value !== '' &&
        villageInput.value !== '' &&
        addressInput.value !== '' &&
        zipcodeInput.value !== '' &&
        nameInput.value !== '' &&
        telpInput.value !== '' &&
        paymentSelectKurir.value !== ''
    ) {
        return true;
    }
    return false;
}

  </script>
    </body>
</html>


