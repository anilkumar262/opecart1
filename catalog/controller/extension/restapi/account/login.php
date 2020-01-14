<?php
class ControllerExtensionRestapiAccountLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('account/customer');

		// Login override for admin users
		if (!empty($this->request->get['token'])) {
			$this->customer->logout();
			$this->cart->clear();

			unset($this->session->data['order_id']);
			unset($this->session->data['payment_address']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['shipping_address']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);

			$customer_info = $this->model_account_customer->getCustomerByToken($this->request->get['token']);

			if ($customer_info && $this->customer->login($customer_info['email'], '', true)) {
				// Default Addresses
				$this->load->model('account/address');

				if ($this->config->get('config_tax_customer') == 'payment') {
					$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				if ($this->config->get('config_tax_customer') == 'shipping') {
					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				return new Action('extension/restapi/account/account');

				//$this->response->redirect($this->url->link('extension/restapi/account/account', '', true));
			}
		}

		if ($this->customer->isLogged()) {
			return new Action('extension/restapi/account/account');
			//$this->response->redirect($this->url->link('extension/restapi/account/account', '', true));
		}

		$this->load->language('account/login');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			// Unset guest
			unset($this->session->data['guest']);

			// Default Shipping Address
			$this->load->model('account/address');

			if ($this->config->get('config_tax_customer') == 'payment') {
				$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
			}

			if ($this->config->get('config_tax_customer') == 'shipping') {
				$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
			}

			// Wishlist
			if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
				$this->load->model('account/wishlist');

				foreach ($this->session->data['wishlist'] as $key => $product_id) {
					$this->model_account_wishlist->addWishlist($product_id);

					unset($this->session->data['wishlist'][$key]);
				}
			}

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$this->model_account_activity->addActivity('login', $activity_data);

			// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {
				return new Action('extension/restapi/account/account');
			} else {

				return new Action('extension/restapi/account/account');
			}
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('extension/restapi/common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('extension/restapi/account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_login'),
			'href' => $this->url->link('extension/restapi/account/login', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_new_customer'] = $this->language->get('text_new_customer');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_register_account'] = $this->language->get('text_register_account');
		$data['text_returning_customer'] = $this->language->get('text_returning_customer');
		$data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
		$data['text_forgotten'] = $this->language->get('text_forgotten');

		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_login'] = $this->language->get('button_login');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['action'] = $this->url->link('extension/restapi/account/login', '', true);
		$data['register'] = $this->url->link('extension/restapi/account/register', '', true);
		$data['forgotten'] = $this->url->link('extension/restapi/account/forgotten', '', true);

		// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
		if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {
			$data['redirect'] = $this->request->post['redirect'];
		} elseif (isset($this->session->data['redirect'])) {
			$data['redirect'] = $this->session->data['redirect'];

			unset($this->session->data['redirect']);
		} else {
			$data['redirect'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			$this->response->addHeader("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		$this->response->addHeader('Access-Control-Allow-Credentials: ' . 'true');
		$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		$this->response->addHeader('Access-Control-Max-Age: 1000');
		$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	protected function validate() {
		// Check how many login attempts have been made.
		$login_info = $this->model_account_customer->getLoginAttempts($this->request->post['email']);

		if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
			$this->error['warning'] = $this->language->get('error_attempts');
		}

		// Check if customer has been approved.
		$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

		if ($customer_info && !$customer_info['status']) {
			$this->error['warning'] = $this->language->get('error_approved');
		}

		if (!$this->error) {
			if (!$this->customer->login($this->request->post['email'], $this->request->post['password'])) {
				$this->error['warning'] = $this->language->get('error_login');

				$this->model_account_customer->addLoginAttempt($this->request->post['email']);
			} else {
				$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
			}
		}

		return !$this->error;
	}

 	public function social()
    {

    	$this->load->model('account/customer');
                        
        if ($this->customer->isLogged())
        {
            return new Action('extension/restapi/account/account');
            //$this->response->redirect($this->url->link('extension/restapi/account/account', '', true));
        }

        $user_data = array(
            'first_name' => $this->request->post['firstname'],
            'last_name' => $this->request->post['lastname'],
            'email' => $this->request->post['email'],
            'phone' => $this->request->post['phone'],
            'password' => $this->generate_hash(8),
        );   

        $email = $user_data['email'];

        $customer_info = $this->model_account_customer->getCustomerByEmail($email);

       // $customer = $this->db->query("SELECT customer_id FROM `" . DB_PREFIX . "customer` WHERE email='" . $email . "'")->row;

        if (!empty($customer_info))
        {
            $customer_id = $customer_info['customer_id'];

	        if (is_numeric($customer_id))
	        {

	            // Everything OK
	            if ($this->login_customer($customer_id))
	            {
	                return new Action('extension/restapi/account/account');
	                //$this->response->redirect($this->url->link('extension/restapi/account/account', '', true));
	            }
	        }
        }

        // Create Customer	
        if (empty($customer_info))
        {
            // Create Customer
            if (($customer_id = $this->create_customer($user_data)) !== false)
            {
                // Login Customer
                if ($this->login_customer($customer_id))
                {
					$user_data['status'] = true;
					if (isset($_SERVER['HTTP_ORIGIN'])) {
			$this->response->addHeader("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
					$this->response->addHeader('Access-Control-Allow-Credentials: ' . 'true');
					$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
					$this->response->addHeader('Access-Control-Max-Age: 1000');
					$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_encode($user_data));
                    
                }
            }
        }

        // User Found
        
    }                    


 	protected function create_customer($data)
    {

        // Email Address
       /* if (empty($data['user_email']) || $this->get_customer_id_by_email($data['user_email']) !== false)
        {
            $data['user_email'] = $this->generate_random_email();
        }*/

        // Customer Data
        $customer_data = array(
            'customer_group_id' => $this->config->get('config_customer_group_id'),
            'firstname' => $data['first_name'],
            'lastname' => $data['last_name'],
            'email' => $data['email'],
            'telephone' => $data['phone'],
            'fax' => '',
            'password' => $data['password'],
            'company' => '',
            'address_1' => '',
            'address_2' => '',
            'city' => '',
            'postcode' => '',
            'country_id' => 0,
            'zone_id' => 0
        );

        $this->load->model('account/customer');

        $customer_id = $this->model_account_customer->addCustomer($customer_data);

        // Customer Added
        if (is_numeric($customer_id))
        {
            return $customer_id;
        }

        // Error

        return false;
    }

    // Login a customer
    protected function login_customer($customer_id)
    {
        // Retrieve the customer
        $result = $this->db->query("SELECT email FROM `" . DB_PREFIX . "customer` WHERE customer_id = '" . intval($customer_id) . "'")->row;
        if (is_array($result) && !empty($result['email']))
        {
            // Login
            if ($this->customer->login($result['email'], '', true))
            {
                unset($this->session->data['guest']);

                // Default Shipping Address
                $this->load->model('account/address');

                if ($this->config->get('config_tax_customer') == 'payment')
                {
                    $this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
                }

                if ($this->config->get('config_tax_customer') == 'shipping')
                {
                    $this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
                }

                // Add to activity log
                $this->load->model('account/activity');

                $activity_data = array(
                    'customer_id' => $this->customer->getId(),
                    'name' => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
                );

                $this->model_account_activity->addActivity('login', $activity_data);

                // Logged in

                return true;
            }
        }

        // Not logged in

        return false;
    }

    protected function generate_hash($length)
    {
        $hash = '';

        for ($i = 0; $i < $length; $i++)
        {
            do
            {
                $char = chr(mt_rand(48, 122));
            } while (!preg_match('/[a-zA-Z0-9]/', $char));

            $hash .= $char;
        }

        return $hash;
    }
}
