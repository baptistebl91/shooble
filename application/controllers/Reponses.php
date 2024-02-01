<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Reponses extends CI_Controller
{
    public function create($id_sondage)
    {
        $hash_titre = $this->input->post("hash_titre");
        $data["sondage"] = $this->Sondage_model->get_sondages($hash_titre);
        $pseudo = $this->session->userdata("pseudo");

        $this->form_validation->set_rules(
            "description",
            "Description",
            "trim|strip_tags"
        );

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header");
            $this->load->view("sondages/view", $data);
            $this->load->view("templates/footer");
        } else {
            $this->Reponse_model->create_reponse($id_sondage, $pseudo);
            redirect("sondages/" . $hash_titre);
        }
    }

    public function date_valid($date)
    {
        if (strtotime($date) < strtotime(date("Y-m-d"))) {
            $this->form_validation->set_message(
                "date_valid",
                "La date entrée est passée."
            );
            return false;
        } else {
            return true;
        }
    }
}
