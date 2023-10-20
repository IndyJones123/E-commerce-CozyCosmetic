<html>
  <head>
    <title>Checkout</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-qObNzMsln4JVIpah"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>
  <body>
    <?= var_dump($test); ?>
     <h3 class="title">Terima Kasih Telah Berbelanja di <?= $this->Settings_model->general()["app_name"]; ?></h3>
            <hr>
            <h4>Kode Pesanan Anda adalah <?= $test ?></h4>
            <p>Kami telah mengirimkan email kepada Anda yang berisi tagihan pesanan. Cek folder Inbox atau Spam untuk melihat email yang kami kirim.</p>
            <hr>
            <strong>Mohon untuk melakukan pembayaran sebesar <h5 class="text-primary">Rp <?= number_format($invoice_id['total'],0,",","."); ?></h5> ke rekening dibawah ini (pilih salah satu): </strong>
    
    <form id="payment-form" method="post" action="<?=base_url()?>/snap/finish">
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form>
    
    <button id="pay-button">Pay!</button>
    <script type="text/javascript">
  
    $('#pay-button').click(function (event) {
      event.preventDefault();
    
    $.ajax({
      url: '<?=base_url()?>snap/token',
      cache: false,

      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });

  </script>


</body>
</html>
