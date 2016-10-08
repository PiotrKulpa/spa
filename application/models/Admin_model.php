<?php
class Admin_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }
		
		//Walidacja logowania na zaplecze
		public function validate()
		{
			
			
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$myquery = $this->db->query("SELECT * FROM users WHERE login = '$login'");
			$row = $myquery->row();
			if (isset($row))
			{
				$hash = $row->password;
				
				if (password_verify($password, $hash)) {
					//echo 'Password is valid!';
					return true;
					
				} else {
					//echo 'Invalid password.';
					return false;
				}
				
				
			} else{
				
				echo 'Nie ma takiego użytkownika';
			}
			
			
		}
		
		public function add_music()
		{
			//Ustawiamy tytuł
			//$rawtitle = $this->upload->data('raw_name');
			//$title = str_replace("_"," ",$rawtitle);
			$title = $this->upload->data('raw_name');

			//Ustawiamy sciezke do pliku
			$rawsrc = $this->upload->data('file_name');
			$baseurl = base_url()."uploads/music/";
			$src = $baseurl.$rawsrc;

			//Ustawiamy czas
			$now = time();
			 // Euro czas
			$date = unix_to_human($now, TRUE, 'eu');
			$musicquery = $this->db->query("INSERT INTO music (mtitle, msrc, mdate) VALUES ('$title', '$src', '$date')");
			
			if ($musicquery) {
					
					
					return true;
					
				} else {
					
					
					return false;
				}
			
		}


		public function add_photo()
		{
			//Ustawiamy tytuł
			
			//Ustawiamy nazwe z rozszerzeniem
			$ext = $this->upload->data('file_name');
			//Ustawiamy nazwe bez rozszerzenia
			$title = $this->upload->data('raw_name');

			//Ustawiamy sciezke do pliku z rozszerzeniem
			$rawsrc = $this->upload->data('file_name');
			$baseurl = base_url()."uploads/photos/";
			$src = $baseurl.$rawsrc;
			
			//Ustawiamy sciezke do pliku z miniaturka
			$thumbbaseurl = base_url()."uploads/photos/thumb/";
			$thumbsrc = $thumbbaseurl.$rawsrc;

			//Ustawiamy czas
			$now = time();
			 // Euro czas
			$date = unix_to_human($now, TRUE, 'eu');
			$musicquery = $this->db->query("INSERT INTO photos (mext, mtitle, msrc, mthumb, mdate) VALUES ('$ext', '$title', '$src', '$thumbsrc', '$date')");
			
			if ($musicquery) {
					
					
					return true;
					
				} else {
					
					
					return false;
				}
			
		}

		public function add_video()
		{
			//Ustawiamy czas
			$now = time();
			 // Euro czas
			$date = unix_to_human($now, TRUE, 'eu');
			//Ustawiamy dane z pol input
			$videotitle = $this->input->post('videotitle');
			$videocode = $this->input->post('videocode');
			$src = "https://www.youtube.com/embed/".$videocode;

			//Walidujemy dane z pol input
			$this->form_validation->set_rules('videotitle', 'Tytuł wideo', 'trim|required', array('required' => 'Musisz podać tytuł wideo.'));
			$this->form_validation->set_rules('videocode', 'Kod wideo', 'trim|required', array('required' => 'Musisz podać kod wideo.'));


			if ($this->form_validation->run() == FALSE)
                {
                        return false;
                }
                else
                {
                        $videoquery = $this->db->query("INSERT INTO video (mtitle, msrc, mdate) VALUES ('$videotitle', '$src', '$date')");
			
			if ($videoquery) {
					
					
					return true;
					
				} else {
					
					
					return false;
				}
                }
		}
		

		
		
		
		
		
		
		


}