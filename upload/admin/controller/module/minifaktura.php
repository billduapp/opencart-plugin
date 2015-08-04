<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ControllerModuleMinifaktura extends Controller
{

	private $error = array();

	public function index()
	{
		/* Load language file. */
		$this->load->language('minifaktura/lang');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		/* Check if data has been posted back. */
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


			$this->model_setting_setting->editSetting('minifaktura', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->cache->delete('minifaktura');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		/* Load language strings. */
		$data['apiKey_title']		 = $this->language->get('apiKey_title');
		$data['apiDomain_title']	 = $this->language->get('apiDomain_title');
		$data['apiSecret_title']	 = $this->language->get('apiSecret_title');
		$data['supplierId_title']	 = $this->language->get('supplierId_title');


		$data['text_edit']		 = $this->language->get('text_edit');
		$data['text_module']	 = $this->language->get('text_module');
		$data['text_enabled']	 = $this->language->get('text_enabled');
		$data['text_disabled']	 = $this->language->get('text_disabled');

		$data['heading_title'] = $this->language->get('heading_title');


		$data['entry_text']		 = $this->language->get('entry_text');
		$data['entry_status']	 = $this->language->get('entry_status');

		$data['button_save']	 = $this->language->get('button_save');
		$data['button_cancel']	 = $this->language->get('button_cancel');

		/* Loading up some URLS. */
		$data['cancel']		 = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$data['form_action'] = $this->url->link('module/minifaktura', 'token=' . $this->session->data['token'], 'SSL');

		/* Present error messages to users. */
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['apiKey']		 = $this->config->get('minifaktura_apiKey');
		$data['apiSecret']	 = $this->config->get('minifaktura_apiSecret');
		$data['apiDomain']	 = $this->config->get('minifaktura_apiDomain');
		$data['supplierId']	 = $this->config->get('minifaktura_supplierId');

		/* Breadcrumb. */
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'	 => $this->language->get('text_home'),
			'href'	 => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'	 => $this->language->get('text_module'),
			'href'	 => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'	 => $this->language->get('heading_title'),
			'href'	 => $this->url->link('module/minifaktura', 'token=' . $this->session->data['token'], 'SSL')
		);

		/* Render some output. */
		$data['header']		 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']		 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('minifaktura/index.tpl', $data));
	}


	public function install()
	{
		$this->load->model('extension/event');
		$this->model_extension_event->addEvent('minifaktura', 'pre.order.add', 'module/minifaktura/onBeforeOrderAdd');
		$this->model_extension_event->addEvent('minifaktura', 'post.order.add', 'module/minifaktura/onPostOrderAdd');
	}


	/* Check user input. */

	private function validate()
	{
		if ($this->error) {
			return false;
		} else {
			return true;
		}
	}


}
