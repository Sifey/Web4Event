<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invite extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper('url_helper');
	}

	public function afficher()
	{
		$data['ivt'] = $this->db_model->get_all_invites();

		$this->load->view('templates/haut');
		$this->load->view('invite', $data);
		$this->load->view('templates/bas');
	}

	public function post()
	{
		//mise en place du formulaire
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('mdp', 'mdp', 'required');
		$this->form_validation->set_rules('post', 'post', 'required|max_length[140]');
		// mise en place des messages d'erreurs
		$this->form_validation->set_message('max_length', 'Un post a 140 caractères maximum');
		$this->form_validation->set_message('required', 'Veuillez remplir le formulaire');

		if ($this->form_validation->run() == FALSE)
		{
			// si le formulaire n'est pas correctement rempli, l'utilisateur est redirigé vers le formulaire
			$this->load->view('templates/haut');
			$this->load->view('post');
			$this->load->view('templates/bas');
		}
		else
		{
			// Initialisation des données à vérifier
			$id = addslashes($this->input->post('id'));
			$mdp = addslashes($this->input->post('mdp'));
			$post = addslashes($this->input->post('post'));
			// Vérification de l'existence du couple de code
			if($this->db_model->check_passeport($id,$mdp))
			{	
				// Si le passeport existe bien (et est activé), on ajout le post
				$this->db_model->insert_post($id, $post);
				$this->load->view('templates/haut');
				$this->load->view('post_succes');
				$this->load->view('templates/bas');
			}
			// Les information entrée ne correspondent à aucun compte existant, l'utilisateur est redirigé vers le formulaire
			else
			{
				$this->load->view('templates/haut');
				$this->load->view('post_erreur');
				$this->load->view('templates/bas');
			}
		}
	}

}
