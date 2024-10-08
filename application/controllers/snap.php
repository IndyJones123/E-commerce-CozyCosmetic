<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'Mid-server-5LB7nYWNOiD8k09yWv7kOR4E', 'production' => true);
		$this->load->model('Payment_model');
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
		$invoice_id = $this->input->get('invoice');
		$invoice = $this->db->get_where('invoice', ['invoice_code' => $invoice_id])->row_array();
		$cart = $this->cart->contents();
		$array = [];

		foreach ($cart as $key => $value) {
			$array[] = $value;
		}

		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => floatval($invoice['total_all']), // no decimal allowed for creditcard
		);

		$item = [];

		foreach ($array as $key => $value) {
			$item[] = array(
				'id' => $value['id'],
				'price' => $value['price'],
				'quantity' => $value['qty'],
				'name' => $value['name']
			);
		}

		$ongkir_details = array(
			'id' => 'ongkir',
			'price' => $invoice['ongkir'],
			'quantity' => 1,
			'name' => 'Ongkir'
		);

		$item[] = $ongkir_details;

		// Optional
		$item_details = $item;

		// Optional
		$customer_details = array(
		  'first_name'    => $invoice['name'],
		  'email'         => "andri@litani.com",
		  'phone'         => $invoice['telp'],
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;

    }
}
