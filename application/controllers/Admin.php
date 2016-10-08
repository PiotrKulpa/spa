<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','date'));
		$this->load->library(array('session', 'form_validation', 'image_lib'));
		$this->load->model('Admin_model');
	}
	
	//Metoda obsługująca logowanie uzytkownika
	public function index()
	{
		
		
			
		$this->form_validation->set_rules('login', 'Login', 'required', array('required' => 'Musisz podać %s.'));
        $this->form_validation->set_rules('password', 'Hasło', 'required',
                        array('required' => 'Musisz podać %s.'));
						
		if ($this->form_validation->run() == FALSE)
		{
			//Brak autoryzacji	
			$data = array(
					'username' => $this->input->post('login'),
					'is_logged_in' => false
				);
		}
		else
		{
			//Sprawdza dane logowania w modelu
			$query = $this->Admin_model->validate();
			
			if($query)
			{
				//Autoryzacja po logowaniu przyznana za pomocą sesji
				$data = array(
					'username' => $this->input->post('login'),
					'is_logged_in' => true
				);
				$this->session->set_userdata($data);
				
				$message = array(
					'ok_status' => 'Dane zostały przesłane'
				);
				
				
				
			}
			else
			{
				//Brak autoryzacji
				$data = array(
					'username' => $this->input->post('login'),
					'is_logged_in' => false
				);
				
			}	
			
		}
		
		$is_logged_in = $this->session->userdata('is_logged_in');
		//$is_logged_in = true;
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
			else{
			//Autoryzacja przyznana za pomocą sesji
			$this->load->view('templates/header-panel');
			$this->load->view('panel');
			$this->load->view('templates/footer');
			}
		
	}
	
	//Wylogowanie
	public function logout()
	{
		
		$this->session->sess_destroy();
		$this->load->view('templates/header-panel');
		$this->load->view('logout');
		$this->load->view('templates/footer');
		
	}
	
	//CRUD
	//Ading music
	public function addmusic()
	{
		//Wymusza zalogowanie do zaplecza
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
		else
		{
			$config['upload_path']          = './uploads/music';
			$config['allowed_types']        = 'mp3';
			$config['max_size']             = 20000;

			$this->load->library('upload', $config);

			//Sprawdza warunki uploadu
			if ( ! $this->upload->do_upload('userfile'))
			{
					//Błąd przesyłania: nie wybrano pliku lub niepoprawne rozszerzenie lub rozmiar;
					$message = array('message' => '<div class="alert alert-danger">Nie wybrałeś pliku, plik jest za duży lub ma złe rozszerzenie</div>');

					$this->load->view('templates/header-panel');
					$this->load->view('panel', $message);
					$this->load->view('templates/footer');
					
			}
			else
			{
					//Warunki uploadu został spełnione
					$data = array('upload_data' => $this->upload->data());
					
					$query = $this->Admin_model->add_music();
			
					if($query) // Jeśli zapytanie do bazy jest poprawne plik został dodany...
					{
						//Dodano muzyke
						$message = array('message' => '<div class="alert alert-success">Przesłałeś 1 plik</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $message);
						$this->load->view('templates/footer');
					}
					else // Niepoprawne zapytanie do bazy lub serwer nie odpowiada
					{
						
						$message = array('message' => '<div class="alert alert-danger">Przesłanie nie powiadło się</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $message);
						$this->load->view('templates/footer');
						
					}

					
			}
		}
	}

	//Delete music
	public function deletemusic($fileid)
	{
		//Wymusza zalogowanie do zaplecza
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
		else
		{

			$query = $this->db->query("SELECT mtitle FROM music WHERE id = '$fileid'");
			$rowCheck = $query->row();
			
			if (!isset($rowCheck)){
				
				$message = array('message' => '<div class="alert alert-danger">Nie ma takiego pliku</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $message);
						$this->load->view('templates/footer');
			}
			else
			{
				$row = $query->row();
				$current_music = $row->mtitle;
				unlink('./uploads/music/'.$current_music.'.mp3');
				//delete record
				$this->db->where('id', $fileid);
				$this->db->delete('music');

				$message = array('message' => '<div class="alert alert-success">Plik został usunięty</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $message);
						$this->load->view('templates/footer');
				
			}
		}

	}

	//Adding photos
	public function addphoto()
	{
		//Wymusza zalogowanie do zaplecza
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
		else
		{
			$config['upload_path']          = './uploads/photos';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 3000;

			$this->load->library('upload', $config);

			//Sprawdza warunki uploadu
			if ( ! $this->upload->do_upload('userfile_photo'))
			{
					//Błąd przesyłania: nie wybrano pliku lub niepoprawne rozszerzenie lub rozmiar;
					$photo_message = array('photo_message' => '<div class="alert alert-danger">Nie wybrałeś pliku, plik jest za duży lub ma złe rozszerzenie</div>');

					$this->load->view('templates/header-panel');
					$this->load->view('panel', $photo_message);
					$this->load->view('templates/footer');
					
			}
			else
			{
					//Warunki uploadu został spełnione
					$data = array('upload_data' => $this->upload->data());
					
					//Tworzenie miniaturki w folderze thumb
					$myimagename = $this->upload->data('file_name');
					list($width, $height, $type, $attr) = getimagesize("uploads/photos/".$myimagename);
					if($width >= $height)
					{
						$mydim = 'height';
					}
					else
					{
						$mydim = 'width';
					}
				
					$config['image_library'] = 'GD2';
					$config['source_image'] = 'uploads/photos/'.$myimagename;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['master_dim'] = $mydim;
					$config['height'] = '200';
					$config['width'] = '200';
					$config['new_image'] = 'uploads/photos/thumb';
					
					$this->image_lib->initialize($config);

					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}else
					{
						list($thumbwidth, $thumbheight) = getimagesize("uploads/photos/thumb/".$myimagename);
						if($thumbwidth >= $thumbheight)
						{
							$my_x_axis = ($thumbwidth - 200) / 2 ;
							$my_y_axis = 0;
						}
						else
						{
							$my_y_axis = ($thumbheight - 200) / 2 ;
							$my_x_axis = 0;
						}
					}
					
					$config2['image_library'] = 'GD2';
					$config2['source_image'] = 'uploads/photos/thumb/'.$myimagename;
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = FALSE;
					$config2['height'] = '200';
					$config2['width'] = '200';
					$config2['x_axis'] = $my_x_axis;
					$config2['y_axis'] = $my_y_axis;
					
					$this->image_lib->initialize($config2);
					
					
					if ( ! $this->image_lib->crop())
					{
						echo $this->image_lib->display_errors();
					}else
					{
						//Przyciecie zdjecia udalo sie
					}

					//Sprawdza zapytanie do bazy
					
					$query = $this->Admin_model->add_photo();
			
					if($query) // Jeśli zapytanie do bazy jest poprawne plik został dodany...
					{
						//Dodano zdjecie
						$photo_message = array('photo_message' => '<div class="alert alert-success">Przesłałeś 1 plik</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $photo_message);
						$this->load->view('templates/footer');
					}
					else // Niepoprawne zapytanie do bazy lub serwer nie odpowiada
					{
						
						$photo_message = array('photo_message' => '<div class="alert alert-danger">Przesłanie nie powiadło się</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $photo_message);
						$this->load->view('templates/footer');
						
					}

					
			}
		}
	}

	public function deletephoto($fileid)
	{
		//Wymusza zalogowanie do zaplecza
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
		else
		{

			$query = $this->db->query("SELECT * FROM photos WHERE id = '$fileid'");
			$rowCheck = $query->row();
			
			if (!isset($rowCheck)){
				
				$photo_message = array('photo_message' => '<div class="alert alert-danger">Nie ma takiego pliku</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $photo_message);
						$this->load->view('templates/footer');
			}else{
				$row = $query->row();
				$current_photo = $row->mext;
				unlink('./uploads/photos/'.$current_photo);
				//delete record
				$this->db->where('id', $fileid);
				$this->db->delete('photos');

				$photo_message = array('photo_message' => '<div class="alert alert-success">Plik został usunięty</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $photo_message);
						$this->load->view('templates/footer');
				
			}
		}

	}

	public function addvideo()
	{
		//Wymusza zalogowanie do zaplecza
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
		else
		{
			$query = $this->Admin_model->add_video();

			if($query)
			{
				$video_message = array('video_message' => '<div class="alert alert-success">Plik został przesłany</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $video_message);
						$this->load->view('templates/footer');
			}
			else
			{
				$video_message = array('video_message' => '<div class="alert alert-danger">Wystąpił błąd podczas przesyłania</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $video_message);
						$this->load->view('templates/footer');
			}
		}

	}

	public function deletevideo($fileid)
	{
		//Wymusza zalogowanie do zaplecza
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//Brak autoryzacji	
			$this->load->view('templates/header');
			$this->load->view('admin');
			$this->load->view('templates/footer');
			
		}
		else
		{
			$query = $this->db->query("SELECT * FROM video WHERE id = '$fileid'");
			$rowCheck = $query->row();
			
			if (!isset($rowCheck)){
				
				$video_message = array('video_message' => '<div class="alert alert-danger">Nie ma takiego pliku</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $video_message);
						$this->load->view('templates/footer');
			}else{
				$row = $query->row();
				//$current_video = $row->mtitle;
				//delete record
				$this->db->where('id', $fileid);
				$this->db->delete('video');

				$video_message = array('video_message' => '<div class="alert alert-success">Plik został usunięty</div>');
						$this->load->view('templates/header-panel');
						$this->load->view('panel', $video_message);
						$this->load->view('templates/footer');
				
			}
		}
	}
	public function testgit()
	{
		//To funkcja testująca Git
	}
	
}
