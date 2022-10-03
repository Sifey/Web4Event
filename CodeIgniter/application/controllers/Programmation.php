<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Programmation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    // Affiche toutes les données relative à une animation
    public function afficher()
    {
        $data['ani'] = $this->db_model->get_all_animations();

        $this->load->view('templates/haut');
        $this->load->view('programmation', $data);
        $this->load->view('templates/bas');
    }

    // Affichage des invités liés à l'animations
    public function invite($id)
    {
        $data['ivt'] = $this->db_model->get_invite_animation($id);

        $this->load->view('templates/haut');
        $this->load->view('anim_invite', $data);
        $this->load->view('templates/bas');
    }

    // Affiche les détails suplémentaire d'une animation
    public function detail($id)
    {
        $data['anim'] = $this->db_model->get_animation($id);

        $this->load->view('templates/haut');
        $this->load->view('anim_detail', $data);
        $this->load->view('templates/bas');
    }

    // Affiche les données lié au lieu et ses services
    public function lieu($id)
    {
        if ($id == 0){
            $data['lieu'] = NULL;
        }
        else {
            $data['lieu'] = $this->db_model->get_lieu_animation($id);
        }

        $this->load->view('templates/haut');
        $this->load->view('anim_lieu', $data);
        $this->load->view('templates/bas');
    }
}
?>