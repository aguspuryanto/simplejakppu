<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index() {
		$data['userdata'] 		= $this->userdata;

		$data['model'] = $this->M_admin;
		$data['dataProvider'] = $this->M_admin->select_all();

		
		$data['page'] 			= "profile";
		$data['judul'] 			= "Profile";
		$data['deskripsi'] 		= "Setting Profile";

		// $data['listuser']		= [];
		$this->template->views('profile', $data);
	}

	public function update() {
		$this->load->library('form_validation');

		$model = $this->M_admin;

		// $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[15]');
		// $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules($model->rules());

		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		$id = $this->userdata->id;
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			// $config['upload_path'] = './assets/img/';
			$config['upload_path']	 = FCPATH . '/assets/img/';
			$config['allowed_types'] = 'jpg|png';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data_foto = $this->upload->data();
				$data['foto'] = $data_foto['file_name'];
			}

			$result = $this->M_admin->update($data, $id);
			if ($result > 0) {
				$this->updateProfil();
				$this->session->set_flashdata('msg', show_succ_msg('Data Profile Berhasil diubah'));
				redirect('Profile');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Data Profile Gagal diubah'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}

	public function ubah_password() {
		$this->form_validation->set_rules('passLama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('passBaru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('passKonf', 'Password Konfirmasi', 'trim|required');

		$id = $this->userdata->id;
		if ($this->form_validation->run() == TRUE) {
			if (md5($this->input->post('passLama')) == $this->userdata->password) {
				if ($this->input->post('passBaru') != $this->input->post('passKonf')) {
					$this->session->set_flashdata('msg', show_err_msg('Password Baru dan Konfirmasi Password harus sama'));
					redirect('Profile');
				} else {
					$data = [
						'password' => md5($this->input->post('passBaru'))
					];

					$result = $this->M_admin->update($data, $id);
					if ($result > 0) {
						$this->updateProfil();
						$this->session->set_flashdata('msg', show_succ_msg('Password Berhasil diubah'));
						redirect('Profile');
					} else {
						$this->session->set_flashdata('msg', show_err_msg('Password Gagal diubah'));
						redirect('Profile');
					}
				}
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Password Salah'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}

	public function useradd() {
		// $config['upload_path']          = './assets/img/';
		$config['upload_path']          = FCPATH . '/assets/img/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['overwrite']        	= TRUE;
		$config['max_size']             = '100';
		$config['max_width']            = '1024';
		$config['max_height']           = '768';

		$this->load->library('upload', $config);

		// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
		$this->upload->initialize($config);

		// echo print_r($_FILES);
		// $json = array();
		if (!$this->upload->do_upload('foto')) {
			$json = array('error' => $this->upload->display_errors());
		} else {
			// $json = array('upload_data' => $this->upload->data());
			$model = $this->M_admin;

			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'nama' => $this->input->post('nama'),
				'foto' => $_FILES['foto']['name'], //$this->input->post('foto'),
				'rule' => $this->input->post('rule'),
			);

			$model->save($data);
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
			$json = array_merge($json, array(
				'upload_data' => $this->upload->data()
			));
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */