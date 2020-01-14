<?php
class ControllerExtensionRestapiModuleMstoreapp extends Controller {
	public function index() {

		$this->load->model('extension/mstoreapp/blocks');

		$this->load->model('tool/image');

		if(isset($this->request->get['id'])){
			$id = $this->request->get['id'];
		} else $id = 0;

		$results = array();
			
		$results['blocks'] = $this->model_extension_mstoreapp_blocks->getBlocks($id);

		foreach ($results['blocks'] as $key => $value) {

			if ($results['blocks'][$key]['image_url'] != '' && $results['blocks'][$key]['image_width'] != 0 && $results['blocks'][$key]['image_height'] != 0)
			$results['blocks'][$key]['image'] = $this->model_tool_image->resize($results['blocks'][$key]['image_url'], $results['blocks'][$key]['image_width'], $results['blocks'][$key]['image_height']);
			$results['blocks'][$key]['children'] = $this->getChildren($value['id']);

		}

		$results['settings'] = $this->get_settings();

		$results['dimensions'] = array(
			'imageHeight' => $results['settings']['mstoreapp_imageHeight'],
			'productSliderWidth' => $results['settings']['mstoreapp_productSliderWidth'], 
			'latestPerRow' => $results['settings']['mstoreapp_latestPerRow'], 
			'productsPerRow' => $results['settings']['mstoreapp_productsPerRow'], 
			'searchPerRow' => $results['settings']['mstoreapp_searchPerRow'],
			'productBorderRadius' => $results['settings']['mstoreapp_productBorderRadius'],
			'productPadding' => $results['settings']['mstoreapp_productPadding']
		);

		$results['theme'] = array(
			'tabBar' => $results['settings']['mstoreapp_themetabBar'],
			'header' => $results['settings']['mstoreapp_themeHeader'], 
			'button' => $results['settings']['mstoreapp_themeButton']
		);

		$results['categories'] = $this->get_categories();

		$results['local'] = $this->load->controller('extension/restapi/common/local');
		$results['isLoggedIn'] = $this->customer->isLogged();

		if (isset($_SERVER['HTTP_ORIGIN'])) {
			$this->response->addHeader("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		$this->response->addHeader('Access-Control-Allow-Credentials: ' . 'true');
		$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		$this->response->addHeader('Access-Control-Max-Age: 1000');
		$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($results));

	}

	public function getChildren($id){

		$this->load->model('extension/mstoreapp/blocks');

		$this->load->model('tool/image');
		
		$children_data = $this->model_extension_mstoreapp_blocks->getBlocks($id);

		if (!empty($children_data)) {
			
			foreach ($children_data as $key => $value) {

			if ($children_data[$key]['image_url'] != '' && $children_data[$key]['image_width'] != 0 && $children_data[$key]['image_height'] != 0)
			$children_data[$key]['image'] = $this->model_tool_image->resize($children_data[$key]['image_url'], $children_data[$key]['image_width'], $children_data[$key]['image_height']);
			$children_data[$key]['children'] = $this->getChildren($value['id']);
			
			}
		}

		return $children_data;
	}

	public function get_categories(){

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			$children_data = array();

			if ($category['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					if ($child['image']) {
					$image =  $this->model_tool_image->resize($child['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height'));
				    }else $image = '';

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'image'    => $image,
						'href' => $this->url->link('extension/restapi/product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}
			}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			if ($category['image']) {
				$image =  $this->model_tool_image->resize($category['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height'));
			}else $image = '';

			$data[] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
				'image'    => $image,
				'children'    => $children_data,
				'href'        => $this->url->link('extension/restapi/product/category', 'path=' . $category['category_id'])
			);
		}

		return $data;

	}

	public function get_settings() {

		$settings = array();

		$this->load->model('setting/setting');
		
		$settings = $this->model_setting_setting->getSetting('mstoreapp');

		return $settings;

	}

	public function blocks(){

		$this->load->model('extension/mstoreapp/blocks');

		$results = $this->model_extension_mstoreapp_blocks->getAllBlocks();

		if (isset($_SERVER['HTTP_ORIGIN'])) {
		$this->response->addHeader("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		$this->response->addHeader('Access-Control-Allow-Credentials: ' . 'true');
		$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		$this->response->addHeader('Access-Control-Max-Age: 1000');
		$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($results));

	}	

}