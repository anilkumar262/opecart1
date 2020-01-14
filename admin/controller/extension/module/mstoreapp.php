<?php
class ControllerExtensionModuleMstoreapp extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/mstoreapp');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mstoreapp', $this->request->post);
			$this->model_setting_setting->editSetting('module_mstoreapp_status', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			if(isset($this->request->post['mstoreapp_demo_blocks']) && $this->request->post['mstoreapp_demo_blocks'] != 'no'){

				$this->load->model('extension/mstoreapp/blocks');

				if($this->request->post['mstoreapp_demo_blocks'] == 'basic')
					$this->model_extension_mstoreapp_blocks->basic();

				if($this->request->post['mstoreapp_demo_blocks'] == 'fashion')
					$this->model_extension_mstoreapp_blocks->fashion();
			
			}

			//$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));

		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/mstoreapp', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/mstoreapp', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);


		if (isset($this->request->post['mstoreapp_app_name'])) {
			$data['mstoreapp_app_name'] = $this->request->post['mstoreapp_app_name'];
		} else {
			$data['mstoreapp_app_name'] = $this->config->get('mstoreapp_app_name');
		}

		if (isset($this->request->post['mstoreapp_site_url'])) {
			$data['mstoreapp_site_url'] = $this->request->post['mstoreapp_site_url'];
		} else {
			$data['mstoreapp_site_url'] = $this->config->get('mstoreapp_site_url');
		}


		if (isset($this->request->post['mstoreapp_license_key'])) {
			$data['mstoreapp_License_key'] = $this->request->post['mstoreapp_License_key'];
		} else {
			$data['mstoreapp_License_key'] = $this->config->get('mstoreapp_License_key');
		}

		if (isset($this->request->post['module_mstoreapp_status'])) {
			$data['module_mstoreapp_status'] = $this->request->post['module_mstoreapp_status'];
		} else {
			$data['module_mstoreapp_status'] = $this->config->get('module_mstoreapp_status');
		}

		if (isset($this->request->post['mstoreapp_rate_app_ios'])) {
			$data['mstoreapp_rate_app_ios'] = $this->request->post['mstoreapp_rate_app_ios'];
		} else {
			$data['mstoreapp_rate_app_ios'] = $this->config->get('mstoreapp_rate_app_ios');
		}

		if (isset($this->request->post['mstoreapp_rate_app_android'])) {
			$data['mstoreapp_rate_app_android'] = $this->request->post['mstoreapp_rate_app_android'];
		} else {
			$data['mstoreapp_rate_app_android'] = $this->config->get('mstoreapp_rate_app_android');
		}

		if (isset($this->request->post['mstoreapp_rate_app_windows'])) {
			$data['mstoreapp_rate_app_windows'] = $this->request->post['mstoreapp_rate_app_windows'];
		} else {
			$data['mstoreapp_rate_app_windows'] = $this->config->get('mstoreapp_rate_app_windows');
		}

		if (isset($this->request->post['mstoreapp_share_app'])) {
			$data['mstoreapp_share_app'] = $this->request->post['mstoreapp_share_app'];
		} else {
			$data['mstoreapp_share_app'] = $this->config->get('mstoreapp_share_app');
		}

		if (isset($this->request->post['mstoreapp_support_email'])) {
			$data['mstoreapp_support_email'] = $this->request->post['mstoreapp_support_email'];
		} else {
			$data['mstoreapp_support_email'] = $this->config->get('mstoreapp_support_email');
		}

		if (isset($this->request->post['mstoreapp_onesignal_app_id'])) {
			$data['mstoreapp_onesignal_app_id'] = $this->request->post['mstoreapp_onesignal_app_id'];
		} else {
			$data['mstoreapp_onesignal_app_id'] = $this->config->get('mstoreapp_onesignal_app_id');
		}

		if (isset($this->request->post['mstoreapp_google_project_id'])) {
			$data['mstoreapp_google_project_id'] = $this->request->post['mstoreapp_google_project_id'];
		} else {
			$data['mstoreapp_google_project_id'] = $this->config->get('mstoreapp_google_project_id');
		}

		if (isset($this->request->post['mstoreapp_web_client_id'])) {
			$data['mstoreapp_web_client_id'] = $this->request->post['mstoreapp_web_client_id'];
		} else {
			$data['mstoreapp_web_client_id'] = $this->config->get('mstoreapp_web_client_id');
		}

		if (isset($this->request->post['mstoreapp_language'])) {
			$data['mstoreapp_language'] = $this->request->post['mstoreapp_language'];
		} else {
			$data['mstoreapp_language'] = $this->config->get('mstoreapp_language');
		}
		
		if (isset($this->request->post['direction'])) {
			$data['direction'] = $this->request->post['direction'];
		} else {
			$data['direction'] = $this->config->get('direction');
		}

		if (isset($this->request->post['mstoreapp_app_rate_windows_id'])) {
			$data['mstoreapp_app_rate_windows_id'] = $this->request->post['mstoreapp_app_rate_windows_id'];
		} else {
			$data['mstoreapp_app_rate_windows_id'] = $this->config->get('mstoreapp_app_rate_windows_id');
		}

		if (isset($this->request->post['mstoreapp_share_app_message'])) {
			$data['mstoreapp_share_app_message'] = $this->request->post['mstoreapp_share_app_message'];
		} else {
			$data['mstoreapp_share_app_message'] = $this->config->get('mstoreapp_share_app_message');
		}

		if (isset($this->request->post['mstoreapp_share_app_subject'])) {
			$data['mstoreapp_share_app_subject'] = $this->request->post['mstoreapp_share_app_subject'];
		} else {
			$data['mstoreapp_share_app_subject'] = $this->config->get('mstoreapp_share_app_subject');
		}

		if (isset($this->request->post['mstoreapp_google_sharing'])) {
			$data['mstoreapp_google_sharing'] = $this->request->post['mstoreapp_google_sharing'];
		} else {
			$data['mstoreapp_google_sharing'] = $this->config->get('mstoreapp_google_sharing');
		}


		if (isset($this->request->post['mstoreapp_chooser_title'])) {
			$data['mstoreapp_chooser_title'] = $this->request->post['mstoreapp_chooser_title'];
		} else {
			$data['mstoreapp_chooser_title'] = $this->config->get('mstoreapp_chooser_title');
		}

		if (isset($this->request->post['mstoreapp_web_link'])) {
			$data['mstoreapp_web_link'] = $this->request->post['mstoreapp_web_link'];
		} else {
			$data['mstoreapp_web_link'] = $this->config->get('mstoreapp_web_link');
		}

		if (isset($this->request->post['mstoreapp_phone'])) {
			$data['mstoreapp_phone'] = $this->request->post['mstoreapp_phone'];
		} else {
			$data['mstoreapp_phone'] = $this->config->get('mstoreapp_phone');
		}

		if (isset($this->request->post['mstoreapp_show_rate_app'])) {
			$data['mstoreapp_show_rate_app'] = $this->request->post['mstoreapp_show_rate_app'];
		} else {
			$data['mstoreapp_show_rate_app'] = $this->config->get('mstoreapp_show_rate_app');
		}

		if (isset($this->request->post['mstoreapp_show_share_app'])) {
			$data['mstoreapp_show_share_app'] = $this->request->post['mstoreapp_show_share_app'];
		} else {
			$data['mstoreapp_show_share_app'] = $this->config->get('mstoreapp_show_share_app');
		}

		if (isset($this->request->post['mstoreapp_show_contact'])) {
			$data['mstoreapp_show_contact'] = $this->request->post['mstoreapp_show_contact'];
		} else {
			$data['mstoreapp_show_contact'] = $this->config->get('mstoreapp_show_contact');
		}

		if (isset($this->request->post['mstoreapp_fb_url'])) {
			$data['mstoreapp_fb_url'] = $this->request->post['mstoreapp_fb_url'];
		} else {
			$data['mstoreapp_fb_url'] = $this->config->get('mstoreapp_fb_url');
		}

		if (isset($this->request->post['mstoreapp_twitter_url'])) {
			$data['mstoreapp_twitter_url'] = $this->request->post['mstoreapp_twitter_url'];
		} else {
			$data['mstoreapp_twitter_url'] = $this->config->get('mstoreapp_twitter_url');
		}

		if (isset($this->request->post['mstoreapp_gp_url'])) {
			$data['mstoreapp_gp_url'] = $this->request->post['mstoreapp_gp_url'];
		} else {
			$data['mstoreapp_gp_url'] = $this->config->get('mstoreapp_gp_url');
		}

		if (isset($this->request->post['mstoreapp_themeHeader'])) {
			$data['mstoreapp_themeHeader'] = $this->request->post['mstoreapp_themeHeader'];
		} else {
			$data['mstoreapp_themeHeader'] = $this->config->get('mstoreapp_themeHeader');
		}

		if (isset($this->request->post['mstoreapp_themetabBar'])) {
			$data['mstoreapp_themetabBar'] = $this->request->post['mstoreapp_themetabBar'];
		} else {
			$data['mstoreapp_themetabBar'] = $this->config->get('mstoreapp_themetabBar');
		}

		if (isset($this->request->post['mstoreapp_themeButton'])) {
			$data['mstoreapp_themeButton'] = $this->request->post['mstoreapp_themeButton'];
		} else {
			$data['mstoreapp_themeButton'] = $this->config->get('mstoreapp_themeButton');
		}

		if (isset($this->request->post['mstoreapp_imageHeight'])) {
			$data['mstoreapp_imageHeight'] = $this->request->post['mstoreapp_imageHeight'];
		} else {
			$data['mstoreapp_imageHeight'] = $this->config->get('mstoreapp_imageHeight');
		}

		if (isset($this->request->post['mstoreapp_productSliderWidth'])) {
			$data['mstoreapp_productSliderWidth'] = $this->request->post['mstoreapp_productSliderWidth'];
		} else {
			$data['mstoreapp_productSliderWidth'] = $this->config->get('mstoreapp_productSliderWidth');
		}

		if (isset($this->request->post['mstoreapp_productBorderRadius'])) {
			$data['mstoreapp_productBorderRadius'] = $this->request->post['mstoreapp_productBorderRadius'];
		} else {
			$data['mstoreapp_productBorderRadius'] = $this->config->get('mstoreapp_productBorderRadius');
		}

		if (isset($this->request->post['mstoreapp_productPadding'])) {
			$data['mstoreapp_productPadding'] = $this->request->post['mstoreapp_productPadding'];
		} else {
			$data['mstoreapp_productPadding'] = $this->config->get('mstoreapp_productPadding');
		}

		if (isset($this->request->post['mstoreapp_latestPerRow'])) {
			$data['mstoreapp_latestPerRow'] = $this->request->post['mstoreapp_latestPerRow'];
		} else {
			$data['mstoreapp_latestPerRow'] = $this->config->get('mstoreapp_latestPerRow');
		}

		if (isset($this->request->post['mstoreapp_productsPerRow'])) {
			$data['mstoreapp_productsPerRow'] = $this->request->post['mstoreapp_productsPerRow'];
		} else {
			$data['mstoreapp_productsPerRow'] = $this->config->get('mstoreapp_productsPerRow');
		}

		if (isset($this->request->post['mstoreapp_searchPerRow'])) {
			$data['mstoreapp_searchPerRow'] = $this->request->post['mstoreapp_searchPerRow'];
		} else {
			$data['mstoreapp_searchPerRow'] = $this->config->get('mstoreapp_searchPerRow');
		}

		if (isset($this->request->post['mstoreapp_productShadow'])) {
			$data['mstoreapp_productShadow'] = $this->request->post['mstoreapp_productShadow'];
		} else {
			$data['mstoreapp_productShadow'] = $this->config->get('mstoreapp_productShadow');
		}

		
		if (isset($this->request->post['mstoreapp_about_us'])) {
			$data['mstoreapp_about_us'] = $this->request->post['mstoreapp_about_us'];
		} else {
			$data['mstoreapp_about_us'] = $this->config->get('mstoreapp_about_us');
		}

		if (isset($this->request->post['mstoreapp_terms'])) {
			$data['mstoreapp_terms'] = $this->request->post['mstoreapp_terms'];
		} else {
			$data['mstoreapp_terms'] = $this->config->get('mstoreapp_terms');
		}

		
		if (isset($this->request->post['mstoreapp_privacy_policy'])) {
			$data['mstoreapp_privacy_policy'] = $this->request->post['mstoreapp_privacy_policy'];
		} else {
			$data['mstoreapp_privacy_policy'] = $this->config->get('mstoreapp_privacy_policy');
		}

		$this->load->model('tool/image');
		$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/mstoreapp', $data));
	}

	protected function validate() {
		return !false;
	}

	public function install() {
		$this->load->model('setting/setting');
		
		$data['mstoreapp_themeHeader'] = 'background';
		$data['mstoreapp_themetabBar'] = 'background';
		$data['mstoreapp_themeButton'] = 'custom1';

		$data['mstoreapp_imageHeight'] = 100;
		$data['mstoreapp_productSliderWidth'] = 42;
		$data['mstoreapp_productBorderRadius'] = 10;
		$data['mstoreapp_productPadding'] = 5;
		$data['mstoreapp_latestPerRow'] = 2;
		$data['mstoreapp_productsPerRow'] = 2;
		$data['mstoreapp_searchPerRow'] = 2;
		$data['mstoreapp_productShadow'] = 'no-shadow';
		
		$this->model_setting_setting->editSetting('mstoreapp', $data);

	}

}