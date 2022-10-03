<?php
class Db_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

//fonction qui récupère l'ensemble des comptes
	public function get_all_compte()
	{
		$query = $this->db->query("SELECT cpt_pseudo FROM t_compte_cpt;");
		return $query->result_array();
	}

// fonction qui récupère l'ensemble des actualités
	public function get_all_actualites()
	{
		$query = $this->db->query("SELECT act_intitule, act_texte, act_datePublication, cpt_pseudo, act_etat FROM t_actualite_act JOIN t_organisateur_org USING (org_id) WHERE act_etat='V' ORDER BY (act_datePublication) DESC LIMIT 5;");
		return $query->result_array();
	}

// fonction qui récupère l'ensemble des animations et ses informations associées
	public function get_all_animations()
	{
		$query = $this->db->query("SELECT ani_id,ani_intitule,ani_dateDebut,ani_dateFin,lie_id,lie_nom,lie_descriptif, GROUP_CONCAT(cpt_pseudo SEPARATOR ', ') AS IVT,  etat_anim(ani_id) AS ETAT FROM t_invite_ivt JOIN t_realise_rls USING (ivt_id) RIGHT OUTER JOIN t_animation_ani USING (ani_id) LEFT OUTER JOIN t_lieu_lie USING (lie_id) GROUP BY (ani_id) ORDER BY (ETAT), (ani_id);");
		return $query->result_array();
	}

// focntion qui récupère l'ensemble des invités
	public function get_all_invites()
	{
		$query = $this->db->query("SELECT * FROM t_invite_ivt JOIN t_compte_cpt USING (cpt_pseudo) WHERE cpt_etat='A';");
		return $query->result_array();
	}

// Fonction de création de compte
	public function set_compte()
	{
		$this->load->helper('url');
		$id=addslashes($this->input->post('id'));
		$mdp=addslashes($this->input->post('mdp'));
		$req="INSERT INTO t_compte_cpt VALUES ('".$id."','".$mdp."', 'D', 'I');";
			$query = $this->db->query($req);
			return ($query);
	}

// Fonction de connexion au compte 
	public function connect_compte($username, $password)
	{
		// préparation du mot de passe via ajout d'un sel et hachage:
		$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
		$hash_password = hash('sha256', $salt.$password);
		// vérification de correspondance dans la base de données
		$query =$this->db->query("SELECT cpt_pseudo,cpt_mdp
			FROM t_compte_cpt
			WHERE cpt_pseudo='".$username."'
			AND cpt_mdp='".$hash_password."';");
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// Fonction qui renvoie le statut du compte
	public function get_status($username)
	{
		$query =$this->db->query("SELECT cpt_statut
			FROM t_compte_cpt
			WHERE cpt_pseudo='".$username."';");
		$statut = $query->row_array();
		return $statut["cpt_statut"];
	}


	// Fonction qui renvoie l'état du compte
	public function get_etat($username)
	{
		$query =$this->db->query("SELECT cpt_etat
			FROM t_compte_cpt
			WHERE cpt_pseudo='".$username."';");
		$etat = $query->row_array();
		return $etat["cpt_etat"];
	}

	// fonction qui récupère tous les lieux et leurs services associés s'ils existent
	public function get_all_lieu()
	{
		$query = $this->db->query("SELECT * FROM t_lieu_lie LEFT OUTER JOIN t_service_srv USING (lie_id);");
		return $query->result_array();
	}

	// fonction qui renvoie toutes les informations d'un profil spécifique
	public function get_profil($username)
	{
		$query = $this->db->query("SELECT * FROM t_invite_ivt RIGHT OUTER JOIN t_compte_cpt USING (cpt_pseudo) LEFT OUTER JOIN t_organisateur_org USING (cpt_pseudo) WHERE cpt_pseudo ='" .$username. "' ORDER BY (cpt_statut);");
		return $query->row();
	}

	// fonction qui renvoie tous les reseaux d'un invité spécifique s'ils existent
	public function get_reseau($username)
	{
		$query = $this->db->query("SELECT * FROM t_reseau_social_rsl JOIN t_present_prt USING (rsl_id) JOIN t_invite_ivt USING (ivt_id) WHERE cpt_pseudo ='" .$username. "';");
		return $query->result_array();
	}

	// Fonction pour modifier le mot de passe
	public function set_password()
	{
		$this->load->helper('url');
		$username=addslashes($this->input->post('username'));
		$mdp=addslashes($this->input->post('mdp'));
		// Chiffrage du mot de passe
		$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
		$password = hash('sha256', $salt.$mdp);
		// Modification dans la base de donnée
		$req="UPDATE t_compte_cpt SET cpt_mdp = '" .$password. "' WHERE cpt_pseudo = '" .$username. "';";
			$query = $this->db->query($req);
			return ($query);
	}

	// fonction qui renvoie tous les passeports d'un invité spécifique s'ils existent
	public function get_passeport_post($username)
	{
		$query = $this->db->query("SELECT * FROM t_post_pst RIGHT OUTER JOIN t_passeport_psp USING (psp_passID) JOIN t_invite_ivt USING (ivt_id) WHERE cpt_pseudo='" .$username. "';");
		return $query->result_array();
	}

	// fonction qui renvoie les informations relatives à une animation particulière
	public function get_animation($id)
	{
		$query = $this->db->query("SELECT * FROM t_animation_ani WHERE ani_id='" .$id. "';");
		return $query->row();
	}

	// fonction qui recupère l'ensemble des invités participant à une animation spécifique
	public function get_invite_animation($id)
	{
		$query = $this->db->query("SELECT * FROM t_invite_ivt JOIN t_realise_rls USING (ivt_id) WHERE ani_id = '" .$id. "';");
		return $query->result_array();
	}

	// fonction qui recupère les données du lieu et des services associés
	public function get_lieu_animation($id)
	{
		$query = $this->db->query("SELECT * FROM t_lieu_lie LEFT OUTER JOIN t_service_srv USING (lie_id) WHERE lie_id = '" .$id. "';");
		return $query->result_array();
	}

	// fonction qui vérifie l'existence ou non d'un couple de code de passeport
	public function check_passeport($id, $mdp)
	{
		$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
		$hash_password = hash('sha256', $salt.$mdp);
		$query = $this->db->query("SELECT * FROM t_passeport_psp WHERE psp_etat='A' AND psp_passID='" .$id. "' AND psp_passMDP='" .$hash_password. "';");
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// Fonction pour ajouter un post
	public function insert_post($id, $post)
	{
		$req="INSERT INTO t_post_pst VALUES (NULL, '" .$post. "', NOW(), 'V','" .$id. "');";
			$query = $this->db->query($req);
			return ($query);
	}

	// Fonction pour supprimer une animation de la programmation
	public function remove_animation($id)
	{
		$req1="DELETE FROM t_realise_rls WHERE ani_id = '" .$id. "';";
		$req2 = "DELETE FROM t_animation_ani WHERE ani_id = '" .$id. "';";
			$query = $this->db->query($req1);
			$query = $this->db->query($req2);
			return ($query);
	}

}