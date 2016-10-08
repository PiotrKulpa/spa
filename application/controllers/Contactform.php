<?php
class Contactform extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form','url'));
				$this->load->library(array('session', 'form_validation', 'email'));
        }

	public function index()
	{
		
		//Ustawienie reguł walidacji
		$this->form_validation->set_rules('sender', 'E-mail', 'trim|required|valid_email', array('required'=>'Musisz podać poprawny %s.'));
		$this->form_validation->set_rules('sender_message', 'Treść zapytania', 'trim|required', array('required'=>'Musisz podać %s.'));
		
		//Czysci pole msg
		$this->session->set_flashdata('msg','');
		
		//Sprawdza poprawnosc formularza
		if ($this->form_validation->run() === FALSE)
		{
			//Walidacja nie powiaodła się
			//Ustala zmienne do przesłania do widoku - zmienna scroll - kod js powodujacy przejscie do formularza kontaktowego
			$js = array(
			'alert' => '<script>alert("Hello! I am an alert box!!");</script>',     
			'scroll' => '<script>$("html, body").animate({scrollTop:$("#kontakt").position().top}, "fast");</script>',
			'message' => 'My Message');

			$this->load->view('templates/header');
			$this->load->view('home', $js);
			$this->load->view('templates/footer');
			
		}
		else
		{
			//Walidacja powiodła się
			$from_email = $this->input->post('sender');
			$subject = "Zapytanie o imprezę";
			$message = $this->input->post('sender_message');
			$to_email = 'piotrkulpa1982@gmail.com'; 
			
			//Wyślij mail
			$this->email->from($from_email);
			$this->email->to($to_email);
			$this->email->subject($subject);
			$this->email->message($message);
			
			if ($this->email->send())
				{
					// Wysłany
					$js = array(     
					'scroll' => '<script>$("html, body").animate({scrollTop:$("#kontakt").position().top}, "fast");</script>'
					);
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Twój E-mail zostal wysłany!</div>');
					$this->load->view('templates/header');
					$this->load->view('home', $js);
					$this->load->view('templates/footer');
				}
				else
				{
					//Niewysłany
					$js = array(     
					'scroll' => '<script>$("html, body").animate({scrollTop:$("#kontakt").position().top}, "fast");</script>'
					);
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Wystąpił problem podczas wysyłania E-maila. Spróbuj jeszcze raz</div>');
					$this->load->view('templates/header');
					$this->load->view('home', $js);
					$this->load->view('templates/footer');
					
				}
			
		}
	}
}