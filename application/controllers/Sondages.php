<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Sondages extends CI_Controller
{
    public function index($offset = 0)
    {
        if (!$this->session->userdata("est_co")) {
            redirect("utilisateurs/connexion");
        }

        $data["titre"] = "Vos derniers sondages";

        $data["sondages"] = $this->Sondage_model->get_sondages();

        $data["nbr_sondages"] = $this->Sondage_model->how_many_sondages(
            $this->session->userdata("id_utilisateur")
        );

        $this->load->view("templates/header");
        $this->load->view("sondages/index", $data);
        $this->load->view("templates/footer");
    }

    public function view($hash_titre = null)
    {
        $data["sondage"] = $this->Sondage_model->get_sondages($hash_titre);
        $id_sondage = $data["sondage"]["ids"];
        $data["reponses"] = $this->Reponse_model->get_reponses($id_sondage);

        $data["nbrep"] = $this->Reponse_model->get_number_rep(
            $this->session->userdata("id_utilisateur"),
            $id_sondage
        );

        $data["createur"] = $this->Sondage_model->get_createur($id_sondage);

        if (empty($data["sondage"])) {
            show_404();
        }

        $data["titre"] = $data["sondage"]["titre"];

        $this->load->view("templates/header");
        $this->load->view("sondages/view", $data);
        $this->load->view("templates/footer");
    }

    public function create()
    {
        if (!$this->session->userdata("est_co")) {
            redirect("utilisateurs/connexion");
        }

        $data["titre"] = "Créer un sondage";

        $this->form_validation->set_rules(
            "titre",
            "Titre",
            "trim|strip_tags|required"
        );
        $this->form_validation->set_rules(
            "description",
            "trim|strip_tags|required"
        );
        $this->form_validation->set_rules(
            "lieu",
            "Lieu",
            "trim|strip_tags|required"
        );
        $this->form_validation->set_rules(
            "date1",
            "Date",
            "trim|strip_tags|required|callback_date_valid"
        );
        $this->form_validation->set_rules(
            "heure1",
            "Heure",
            "trim|strip_tags|required"
        );
        $this->form_validation->set_rules("date2", "Date", "trim|strip_tags");
        $this->form_validation->set_rules("heure2", "Heure", "trim|strip_tags");
        $this->form_validation->set_rules("date3", "Date", "trim|strip_tags");
        $this->form_validation->set_rules("heure3", "Heure", "trim|strip_tags");

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header");
            $this->load->view("sondages/create", $data);
            $this->load->view("templates/footer");
        } else {
            $this->Sondage_model->create_sondage();
            $this->session->set_flashdata(
                "sondage_cree",
                "Votre sondage a été créé. Copiez ce lien pour le partager : " .
                    $_SERVER["HTTP_HOST"] .
                    "" .
                    base_url() .
                    "sondages/" .
                    $this->Sondage_model->get_hash()
            );
            redirect("sondages");
        }
    }

    public function delete($ids)
    {
        if (!$this->session->userdata("est_co")) {
            redirect("utilisateurs/connexion");
        }

        $this->Sondage_model->delete_sondage($ids);
        $this->session->set_flashdata(
            "sondage_supprime",
            "Votre sondage a été supprimé."
        );
        redirect("sondages");
    }

    public function edit($hash_titre)
    {
        if (!$this->session->userdata("est_co")) {
            redirect("utilisateurs/connexion");
        }

        $data["sondage"] = $this->Sondage_model->get_sondages($hash_titre);

        if (empty($data["sondage"])) {
            show_404();
        }

        $data["titre"] = "Modifier le sondage";

        $this->load->view("templates/header");
        $this->load->view("sondages/edit", $data);
        $this->load->view("templates/footer");
    }

    public function update()
    {
        if (!$this->session->userdata("est_co")) {
            redirect("utilisateurs/connexion");
        }

        $this->Sondage_model->update_sondage();
        $this->session->set_flashdata(
            "sondage_modifie",
            "Votre sondage a été modifié. Copiez ce lien pour le partager : " .
                base_url() .
                "sondages/" .
                $this->Sondage_model->get_hash()
        );
        redirect("sondages/" . $this->Sondage_model->get_hash());
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

    public function results($hash_titre = null)
    {
        $data["sondage"] = $this->Sondage_model->get_sondages($hash_titre);
        $id_sondage = $data["sondage"]["ids"];
        $data["id_sondage"] = $id_sondage;

        $data["participants"] = $this->Sondage_model->get_nbr_participants(
            $id_sondage
        );

        if (
            $this->session->userdata("id_utilisateur") !=
            $data["sondage"]["id_utilisateur"]
        ) {
            redirect("sondages/");
        }

        $creneau1 =
            $data["sondage"]["date1"] . " " . $data["sondage"]["heure1"];
        $creneau2 =
            $data["sondage"]["date2"] . " " . $data["sondage"]["heure2"];
        $creneau3 =
            $data["sondage"]["date3"] . " " . $data["sondage"]["heure3"];

        $data["cr1"] = $this->Sondage_model->get_votes($id_sondage, $creneau1);
        $data["cr2"] = $this->Sondage_model->get_votes($id_sondage, $creneau2);
        $data["cr3"] = $this->Sondage_model->get_votes($id_sondage, $creneau3);

        $data["sondage"] = $this->Sondage_model->get_sondages($hash_titre);

        if (!$this->session->userdata("est_co")) {
            redirect("utilisateurs/connexion");
        }

        $data["titre"] = "Résultats de votre sondage, ";

        $this->load->view("templates/header");
        $this->load->view("sondages/results", $data);
        $this->load->view("templates/footer");
    }
}
