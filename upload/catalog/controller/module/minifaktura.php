<?php

require __DIR__ . '/../../../admin/api-client/vendor/autoload.php';
require('admin/model/sale/order.php');

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ControllerModuleMinifaktura extends Controller
{

	public function onBeforeOrderAdd($order)
	{
		//$this->addOrder($order, $order['products']);
	}


	public function onPostOrderAdd($order_id)
	{
		/*
		$model = new ModelSaleOrder($this->registry);

		$order		 = $model->getOrder($order_id);
		$products	 = $model->getOrderProducts($order_id);

		$this->addOrder($order_id, $order, $products);
		 * 
		 */
	}


	public function addOrder($order_id, $order, $products)
	{
		$items = array();

		foreach ($products as $product) {
			$item = array(
				'label'	 => $product['name'],
				'count'	 => $product['quantity'],
				'price'	 => $product['price'],
				'tax'	 => $product['tax']
			);

			$items[] = $item;
		}

		$this->load->model('setting/setting');
		$apiKey		 = $this->config->get('minifaktura_apiKey');
		$apiSecret	 = $this->config->get('minifaktura_apiSecret');
		$apiDomain	 = $this->config->get('minifaktura_apiDomain');

		$api = new \iInvoices\Api\ApiClient($apiDomain, $apiKey, $apiSecret);

		$data = array(
			'client'	 => array(
				'company'	 => '',
				'name'		 => $order['payment_firstname'],
				'surname'	 => $order['payment_lastname'],
				'email'		 => $order['email']
			),
			'items'		 => $items,
			'customId'	 => $order_id
		);

		try {
			$api->orders->create($data);
		} catch (\Exception $e) {
			echo $e->getBody();
		}
	}


}
