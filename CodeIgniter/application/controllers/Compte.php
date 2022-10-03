<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compte extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper('url_helper');
	}

	public function lister()
	{
		$data['titre'] = 'Liste des pseudos :';
		$data['pseudos'] = $this->db_model->get_all_compte();

		$this->load->view('templates/haut');
		$this->load->view('compte_liste',$data);
		$this->load->view('templates/bas');
	}

	public function creer()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('mdp', 'mdp', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/haut');
			$this->load->view('compte_creer');
			$this->load->view('templates/bas');
		}
		else
		{
			$this->db_model->set_compte();
			$this->load->view('templates/haut');
			$this->load->view('compte_succes');
			$this->load->view('templates/bas');
		}
	}

	public function connecter()
	{	
		// Si la session n'est pas déjà ouverte, on affiche le formulaire
		if (!isset($_SESSION['username'])){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pseudo', 'pseudo', 'required');
			$this->form_validation->set_rules('mdp', 'mdp', 'required');
			$this->form_validation->set_message('required', 'Veuillez remplir tous les champs');
			if ($this->form_validation->run() == FALSE)
			{
				// si le formulaire n'est pas correctement rempli, l'utilisateur est redirigé vers la page de connexion
				$this->load->view('templates/haut');
				$this->load->view('compte_connecter');
				$this->load->view('templates/bas');
			}
			else
			{
				// Mise à jour des données de sessions
				$username = addslashes($this->input->post('pseudo'));
				$password = addslashes($this->input->post('mdp'));
				// Mise à jour des informations:
				$data = array(
			        'username'  => $username,
			        'statut'    => $this->db_model->get_status($username),
			        'etat' 		=> $this->db_model->get_etat($username)
				);
				// Si le compte correspond à un compte existant, on le redirige vers son espace d'administration dédié
				// (si son compte est actif)
				if($this->db_model->connect_compte($username,$password))
				{
					// Si l'utilisateur est un administrateur activé on le redirige vers la page d'administration dédiée
					if ($data['statut']=='A' AND $data['etat']=='A'){
						$this->session->set_userdata($data);
						$this->load->view('templates/menu_administrateur');
						$this->load->view('compte_menu');
						$this->load->view('templates/bas');
					}
					// Si l'utilisateur est un invité activé on le redirige vers la page d'administration dédiée
					else if ($data['statut']=='I' AND $data['etat']=='A')
					{
						$this->session->set_userdata($data);
						$this->load->view('templates/menu_invite');
						$this->load->view('compte_menu');
						$this->load->view('templates/bas');
					}
					// Sinon, l'utilisateur est redirigé vers la page de connexion
					else
					{
						$this->load->view('templates/haut');
						$this->load->view('compte_erreur');
						$this->load->view('templates/bas');
					}
				}
				// Les information entrée ne correspondent à aucun compte existant, l'utilisateur est redirigé vers la page de connexion
				else
				{
					$this->load->view('templates/haut');
					$this->load->view('compte_erreur');
					$this->load->view('templates/bas');
				}
			}
		}
		// Sinon, on affiche directement la page d'accueil
		else {
			// Si l'utilisateur est un administrateur activé on le redirige vers la page d'administration dédiée
			if ($this->session->statut=='A' AND $this->session->etat=='A'){
				$this->load->view('templates/menu_administrateur');
				$this->load->view('compte_menu');
				$this->load->view('templates/bas');
			}
			// Si l'utilisateur est un invité activé on le redirige vers la page d'administration dédiée
			else if ($this->session->statut=='I' AND $this->session->etat=='A')
			{
				$this->load->view('templates/menu_invite');
				$this->load->view('compte_menu');
				$this->load->view('templates/bas');
			}
			// Sinon, l'utilisateur est redirigé vers la page de connexion
			else
			{
				$this->load->view('templates/haut');
				$this->load->view('compte_erreur');
				$this->load->view('templates/bas');
			}
		}
	}

	// Déconnexion du compte connecté
	public function deconnecter()
	{
		if ($this->session->statut == 'A'){
			$this->load->view('templates/menu_administrateur');
			$this->load->view('compte_deconnexion');
			$this->load->view('templates/bas');
		} else {
			$this->load->view('templates/menu_invite');
			$this->load->view('compte_deconnexion');
			$this->load->view('templates/bas');
		}
	}	

	// Gestion du profil de l'utilisateur connecter
	public function profil()
	{	
		$username = $this->session->username;
		$data['profil'] = $this->db_model->get_profil($username);
		// Si l'utilisateur est un invité, il est redirigé vers sa page dédié
		if ($this->session->statut == 'I'){
			$data['reseau'] = $this->db_model->get_reseau($username);
			$this->load->view('templates/menu_invite');
			$this->load->view('compte_profil', $data);
			$this->load->view('templates/bas');
		// Si l'utilisateur est un organisateur, il est redirigé vers sa page dédié
		} else if ($this->session->statut == 'A') {
			$this->load->view('templates/menu_administrateur');
			$this->load->view('compte_profil', $data);
			$this->load->view('templates/bas');
		// Sinon l'utilisateur est redirigé vers la page d'accueil
		} else {
			redirect(base_url());
		}
	}

	// Modification (du mot de passe)
	public function modification()
	{	
		$username = $this->session->username;
		$data['profil'] = $this->db_model->get_profil($username);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mdp', 'mdp', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[mdp]');
		$this->form_validation->set_message('matches', 'Confirmation du mot de passe erronée, veuillez réessayer !');
		$this->form_validation->set_message('required', 'Champs de saisie vides !');
		if ($this->form_validation->run() == FALSE)
		{
			if ($this->session->statut == 'A'){
				$this->load->view('templates/menu_administrateur');
				$this->load->view('compte_modification', $data);
				$this->load->view('templates/bas');
			} else if ($this->session->statut == 'I'){
				$data['reseau'] = $this->db_model->get_reseau($username);
				$this->load->view('templates/menu_invite');
				$this->load->view('compte_modification', $data);
				$this->load->view('templates/bas');
			}
		}
		else
		{
			$this->db_model->set_password();
			if ($this->session->statut == 'A'){
				$this->load->view('templates/menu_administrateur');
				$this->load->view('compte_succes');
				$this->load->view('templates/bas');
			} else if ($this->session->statut == 'I'){
				$this->load->view('templates/menu_invite');
				$this->load->view('compte_succes');
				$this->load->view('templates/bas');
			}
		}
	}

	// Affichage des passeports et posts associé à un invité
	public function passeport()
	{	
		$username = $this->session->username;
		$data['passeport'] = $this->db_model->get_passeport_post($username);
		if ($this->session->statut == 'I'){
				$this->load->view('templates/menu_invite');
				$this->load->view('compte_passeport', $data);
				$this->load->view('templates/bas');
		}
		else
		{
			$this->load->view('templates/menu_administrateur');
			$this->load->view('compte_menu');
			$this->load->view('templates/bas');
		}
	}

	// Gestion des animations par des administrateur
	public function programmation()
	{
		$data['ani'] = $this->db_model->get_all_animations();

        $this->load->view('templates/menu_administrateur');
        $this->load->view('compte_programmation', $data);
        $this->load->view('templates/bas');
	}

	// Confirmation de suppression d'une animation par un admnistrateur
	public function confirmation_suppression($id)
	{
		$data['ani'] = $this->db_model->get_animation($id);

		$this->load->view('templates/menu_administrateur');
        $this->load->view('animation_action', $data);
        $this->load->view('templates/bas');
	}

	// Suppression d'une animation par un admnistrateur
	public function suppression_animation($id)
	{
		if (isset($_SESSION['username'])){
			$this->db_model->remove_animation($id);
			redirect(base_url()."index.php/compte/programmation");
		}
		else {
			redirect(base_url());
		}
	}	

}
