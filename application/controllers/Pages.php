<?php
class Pages extends CI_Controller
{
    public function view($page = "accueil")
    {
        if (!file_exists(APPPATH . "views/pages/" . $page . ".php")) {
            show_404();
        }

        $data["titre"] = ucfirst($page);
        $data["est_co"] = $this->session->userdata("est_co");

        $this->load->view("templates/header");
        $this->load->view("pages/" . $page, $data);
        $this->load->view("templates/footer");
    }
}
