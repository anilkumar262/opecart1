<?php
class ControllerExtensionModuleMstoreappBlocks extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/mstoreapp_blocks');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/mstoreapp/blocks');

		$this->getList();
	}

	public function add() {
		$this->load->language('extension/module/mstoreapp_blocks');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/mstoreapp/blocks');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_mstoreapp_blocks->addBlock($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('extension/module/mstoreapp_blocks');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/mstoreapp/blocks');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_mstoreapp_blocks->editBlock($this->request->get['id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('extension/module/mstoreapp_blocks');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/mstoreapp/blocks');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_extension_mstoreapp_blocks->deleteBlock($id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function repair() {
		$this->load->language('extension/module/mstoreapp_blocks');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/mstoreapp/blocks');

		if ($this->validateRepair()) {
			$this->model_extension_mstoreapp_blocks->repairCategories();

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('extension/module/mstoreapp_blocks/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('extension/module/mstoreapp_blocks/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['repair'] = $this->url->link('extension/module/mstoreapp_blocks/repair', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['categories'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$block_total = $this->model_extension_mstoreapp_blocks->getTotalBlocks();

		$results = $this->model_extension_mstoreapp_blocks->getBlocks($filter_data);

		foreach ($results as $result) {
			$data['blocks'][] = array(
				'id' 		  => $result['id'],
				'parent_name' => $result['parent_name'],
				'name'        => $result['name'],
				'description' => $result['description'],
				'sort_order'  => $result['sort_order'],
				'edit'        => $this->url->link('extension/module/mstoreapp_blocks/edit', 'user_token=' . $this->session->data['user_token'] . '&id=' . $result['id'] . $url, true),
				'delete'      => $this->url->link('extension/module/mstoreapp_blocks/delete', 'user_token=' . $this->session->data['user_token'] . '&id=' . $result['id'] . $url, true)
			);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['sort_id'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . '&sort=id' . $url, true);
		$data['sort_parent_id'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . '&sort=parent_id' . $url, true);
		$data['sort_parent_name'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . '&sort=parent_name' . $url, true);
		$data['sort_name'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url, true);
		$data['sort_description'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . '&sort=description' . $url, true);
		$data['sort_sort_order'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total  = $block_total;
		$pagination->page   = $page;
		$pagination->limit  = $this->config->get('config_limit_admin');
		$pagination->url    = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($block_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($block_total - $this->config->get('config_limit_admin'))) ? $block_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $block_total, ceil($block_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/mstoreapp_blocks', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$parent_block = $this->model_extension_mstoreapp_blocks->getBlocks();

		foreach ($parent_block as $parents) {
			$data['parent_blocks'][] = array(
				'id' => $parents['id'],
				'name' => $parents['name'],
				'parent_id' => $parents['parent_id'],
			);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		if (isset($this->error['parent'])) {
			$data['error_parent'] = $this->error['parent'];
		} else {
			$data['error_parent'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('extension/module/mstoreapp_blocks/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('extension/module/mstoreapp_blocks/edit', 'user_token=' . $this->session->data['user_token'] . '&id=' . $this->request->get['id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('extension/module/mstoreapp_blocks', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$blocks = $this->model_extension_mstoreapp_blocks->getBlock($this->request->get['id']);
		}

		$data['user_token'] = $this->session->data['user_token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['parent_id'])) {
			$data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($blocks)) {
			$data['parent_id'] = $blocks['parent_id'];
		} else {
			$data['parent_id'] = 0;
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($blocks)) {
			$data['name'] = $blocks['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (!empty($blocks)) {
			$data['description'] = $blocks['description'];
		} else {
			$data['description'] = '';
		}

		if (isset($this->request->post['image_url'])) {
			$data['image_url'] = $this->request->post['image_url'];
		} elseif (!empty($blocks)) {
			$data['image_url'] = $blocks['image_url'];
		} else {
			$data['image_url'] = '';
		}

		if (isset($this->request->post['image_width'])) {
			$data['image_width'] = $this->request->post['image_width'];
		} elseif (!empty($blocks)) {
			$data['image_width'] = $blocks['image_width'];
		} else {
			$data['image_width'] = 200;
		}

		if (isset($this->request->post['image_height'])) {
			$data['image_height'] = $this->request->post['image_height'];
		} elseif (!empty($blocks)) {
			$data['image_height'] = $blocks['image_height'];
		} else {
			$data['image_height'] = 200;
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image_url']) && is_file(DIR_IMAGE . $this->request->post['image_url'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image_url'], 100, 100);
		} elseif (!empty($blocks) && is_file(DIR_IMAGE . $blocks['image_url'])) {
			$data['thumb'] = $this->model_tool_image->resize($blocks['image_url'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($blocks)) {
			$data['sort_order'] = $blocks['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}

		if (isset($this->request->post['block_type'])) {
			$data['block_type'] = $this->request->post['block_type'];
		} elseif (!empty($blocks)) {
			$data['block_type'] = $blocks['block_type'];
		} else {
			$data['block_type'] = 0;
		}

		if (isset($this->request->post['link_type'])) {
			$data['link_type'] = $this->request->post['link_type'];
		} elseif (!empty($blocks)) {
			$data['link_type'] = $blocks['link_type'];
		} else {
			$data['link_type'] = 0;
		}

		if (isset($this->request->post['link_id'])) {
			$data['link_id'] = $this->request->post['link_id'];
		} elseif (!empty($blocks)) {
			$data['link_id'] = $blocks['link_id'];
		} else {
			$data['link_id'] = true;
		}


		if (isset($this->request->post['end_time'])) {
			$data['end_time'] = $this->request->post['end_time'];
		} elseif (!empty($blocks)) {
			$data['end_time'] = $blocks['end_time'];
		} else {
			$data['end_time'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($blocks)) {
			$data['status'] = $blocks['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['border_radius'])) {
			$data['border_radius'] = $this->request->post['border_radius'];
		} elseif (!empty($blocks)) {
			$data['border_radius'] = $blocks['border_radius'];
		} else {
			$data['border_radius'] = 0;
		}

		if (isset($this->request->post['margin_between'])) {
			$data['margin_between'] = $this->request->post['margin_between'];
		} elseif (!empty($blocks)) {
			$data['margin_between'] = $blocks['margin_between'];
		} else {
			$data['margin_between'] = 10;
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($blocks['width'])) {
			$data['width'] = $blocks['width'];
		} else {
			$data['width'] = 100;
		}

		if (isset($this->request->post['margin_top'])) {
			$data['margin_top'] = $this->request->post['margin_top'];
		} elseif (!empty($blocks)) {
			$data['margin_top'] = $blocks['margin_top'];
		} else {
			$data['margin_top'] = 0;
		}

		if (isset($this->request->post['margin_right'])) {
			$data['margin_right'] = $this->request->post['margin_right'];
		} elseif (!empty($blocks)) {
			$data['margin_right'] = $blocks['margin_right'];
		} else {
			$data['margin_right'] = 0;
		}


		if (isset($this->request->post['margin_bottom'])) {
			$data['margin_bottom'] = $this->request->post['margin_bottom'];
		} elseif (!empty($blocks)) {
			$data['margin_bottom'] = $blocks['margin_bottom'];
		} else {
			$data['margin_bottom'] = 0;
		}

		if (isset($this->request->post['margin_left'])) {
			$data['margin_left'] = $this->request->post['margin_left'];
		} elseif (!empty($blocks)) {
			$data['margin_left'] = $blocks['margin_left'];
		} else {
			$data['margin_left'] = 0;
		}

		if (isset($this->request->post['padding_top'])) {
			$data['padding_top'] = $this->request->post['padding_top'];
		} elseif (!empty($blocks)) {
			$data['padding_top'] = $blocks['padding_top'];
		} else {
			$data['padding_top'] = 0;
		}


		if (isset($this->request->post['padding_right'])) {
			$data['padding_right'] = $this->request->post['padding_right'];
		} elseif (!empty($blocks)) {
			$data['padding_right'] = $blocks['padding_right'];
		} else {
			$data['padding_right'] = 0;
		}

		if (isset($this->request->post['padding_bottom'])) {
			$data['padding_bottom'] = $this->request->post['padding_bottom'];
		} elseif (!empty($blocks)) {
			$data['padding_bottom'] = $blocks['padding_bottom'];
		} else {
			$data['padding_bottom'] = 0;
		}


		if (isset($this->request->post['padding_left'])) {
			$data['padding_left'] = $this->request->post['padding_left'];
		} elseif (!empty($blocks)) {
			$data['padding_left'] = $blocks['padding_left'];
		} else {
			$data['padding_left'] = 0;
		}

		if (isset($this->request->post['layout'])) {
			$data['layout'] = $this->request->post['layout'];
		} elseif (!empty($blocks)) {
			$data['layout'] = $blocks['layout'];
		} else {
			$data['layout'] = true;
		}

		if (isset($this->request->post['layout_grid_col'])) {
			$data['layout_grid_col'] = $this->request->post['layout_grid_col'];
		} elseif (!empty($blocks)) {
			$data['layout_grid_col'] = $blocks['layout_grid_col'];
		} else {
			$data['layout_grid_col'] = '';
		}

		if (isset($this->request->post['shape'])) {
			$data['shape'] = $this->request->post['shape'];
		} elseif (!empty($blocks)) {
			$data['shape'] = $blocks['shape'];
		} else {
			$data['shape'] = true;
		}


		if (isset($this->request->post['card_style'])) {
			$data['card_style'] = $this->request->post['card_style'];
		} elseif (!empty($blocks)) {
			$data['card_style'] = $blocks['card_style'];
		} else {
			$data['card_style'] = true;
		}

		if (isset($this->request->post['header_align'])) {
			$data['header_align'] = $this->request->post['header_align'];
		} elseif (!empty($blocks)) {
			$data['header_align'] = $blocks['header_align'];
		} else {
			$data['header_align'] = true;
		}

		if (isset($this->request->post['text_color'])) {
			$data['text_color'] = $this->request->post['text_color'];
		} elseif (!empty($blocks)) {
			$data['text_color'] = $blocks['text_color'];
		} else {
			$data['text_color'] = '#000000';
		}

		if (isset($this->request->post['bg_color'])) {
			$data['bg_color'] = $this->request->post['bg_color'];
		} elseif (!empty($blocks)) {
			$data['bg_color'] = $blocks['bg_color'];
		} else {
			$data['bg_color'] = '#ffffff';
		}



		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/mstoreapp_block_form', $data));
	}

	protected function validateForm() {

		return true;

		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if (isset($this->request->get['id']) && $this->request->post['parent_id']) {
			$results = $this->model_catalog_category->getCategoryPath($this->request->post['parent_id']);
			
			foreach ($results as $result) {
				if ($result['path_id'] == $this->request->get['id']) {
					$this->error['parent'] = $this->language->get('error_parent');
					
					break;
				}
			}
		}

		if ($this->request->post['category_seo_url']) {
			$this->load->model('design/seo_url');
			
			foreach ($this->request->post['category_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						if (count(array_keys($language, $keyword)) > 1) {
							$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
						}

						$seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);
	
						foreach ($seo_urls as $seo_url) {
							if (($seo_url['store_id'] == $store_id) && (!isset($this->request->get['id']) || ($seo_url['query'] != 'id=' . $this->request->get['id']))) {		
								$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');
				
								break;
							}
						}
					}
				}
			}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_category->getCategories($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'id' => $result['id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function install() {
		$this->load->model('extension/mstoreapp/blocks');

		$this->model_extension_mstoreapp_blocks->install();
	}

	public function uninstall() {
		$this->load->model('extension/mstoreapp/blocks');

		$this->model_extension_mstoreapp_blocks->uninstall();
	}
}