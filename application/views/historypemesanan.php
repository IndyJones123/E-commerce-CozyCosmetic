<!-- Begin Page Content -->
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<script type="text/javascript"
		src="https://app.midtrans.com/snap/snap.js"
		data-client-key="Mid-client-KoICJaU9jpSylJ5G"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<!-- Page Heading -->
			<h1 class="h3 mb-2 text-gray-800 mb-4">Data Pesanan</h1>
			 <?php 
				$email = $this->session->userdata('email');
				$conditions = array(
				  'email' => $email
				);
		
				$orders = $this->db->get_where('invoice', $conditions);
				
			?>
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
				</div>
				<div class="card-body">
					<?php echo $this->session->flashdata('failed'); ?> 
					<?php if($orders->num_rows() > 0){ ?>
					<div class="table-responsive">
						<table
							class="table table-bordered"
							id="dataTable"
							width="100%"
							cellspacing="0"
						>
							<thead>
								<tr>
									<th>Kode/Invoice</th>
									<th>Nama</th>
									<th>Total Pesanan</th>
									<th>Tanggal Pesan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tfoot></tfoot>
							<tbody class="data-content">
								<?php foreach($orders->result_array() as $data): ?>
								<tr>
									<td id="invoice-code"><?= $data['invoice_code']; ?></td>
									<td><?= $data['name']; ?></td>
									<td>Rp <?= number_format($data['total_all'],0,",","."); ?></td>
									<td><?= $data['date_input']; ?></td>
									<?php if($data['courier'] == 'cod'){ ?>
										<td>COD (Cash of Delivery)</td>
									<?php }else{ ?>
										<?php if($data['process'] == 0 && $data['send'] == 0){ ?>
											<td>Belum di proses</td>
										<?php }else if($data['process'] == 1 && $data['send'] == 0){ ?>
											<td>Sedang di proses</td>
										<?php }else{ ?>
											<td><span class="btn rounded-pill btn-sm btn-success">Selesai</span></td>
										<?php } ?>
									<?php } ?>
									<td>
										<a href="<?= base_url() ;?>home/order/<?= $data['invoice_code']; ?>" class="btn rounded-pill btn-sm btn-info"><i class="fa fa-eye"></i></a>
										<?php if ($data['process'] == 0) { ?>
											<a href="<?= base_url(); ?>historypemesanan?invoice=<?= $data['invoice_code']; ?>" class="btn rounded-pill btn-sm btn-warning">Bayar</a>
										<?php } ?>
									</td>
									
								</tr>
								<?php $no++; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php }else{ ?>
					<div class="alert alert-warning" role="alert">
						Opss, pesanan masih kosong.
					</div>
					<?php } ?>
				</div>
				<form id="transaction-success" method="post"></form>
			</div>
		</div>
		<script type="text/javascript">

		const currentUrl = window.location.href;
		const url = new URL(currentUrl);
		const invoice = url.searchParams.get("invoice");
		const transactionSuccess = document.getElementById('transaction-success');

		swal({
            title: 'Loading',
            text: 'Mohon tunggu...',
            icon: 'info',
            buttons: false,
            closeOnClickOutside: false,
            timer: 2000  // Atur waktu penutupan otomatis sesuai kebutuhan Anda
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
		</script>
	</body>
</html>

<!-- /.container-fluid -->
