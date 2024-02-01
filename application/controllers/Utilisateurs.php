<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Utilisateurs extends CI_Controller
{
    //Register user
    public function inscription()
    {
        if ($this->session->userdata("est_co")) {
            redirect("accueil");
        }

        $data["titre"] = "Inscription";

        $this->form_validation->set_rules(
            "nom",
            "Nom",
            "trim|strip_tags|required"
        );
        $this->form_validation->set_rules(
            "prenom",
            "Prénom",
            "trim|strip_tags|required"
        );
        $this->form_validation->set_rules(
            "pseudo",
            "Userame",
            "trim|strip_tags|required|callback_check_pseudo_exists"
        );
        $this->form_validation->set_rules(
            "email",
            "Email",
            "trim|strip_tags|required|callback_check_email_exists"
        );
        $this->form_validation->set_rules(
            "mot_de_passe",
            "Password",
            "trim|strip_tags|required|callback_check_mot_de_passe_size"
        );
        $this->form_validation->set_rules(
            "mot_de_passe2",
            "Confirm Password",
            "trim|strip_tags|required",
            "matches[mot_de_passe]"
        );

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header");
            $this->load->view("utilisateurs/inscription", $data);
            $this->load->view("templates/footer");
        } else {
            // Encrypt mot_de_passe
            $enc_mot_de_passe = md5($this->input->post("mot_de_passe"));

            $this->Utilisateur_model->inscription($enc_mot_de_passe);

            //Set message
            $this->session->set_flashdata(
                "utilisateur_inscrit",
                "Vous êtes inscrits et vous pouvez dès maintenant vous connecter."
            );
            redirect("utilisateurs/connexion");
        }
    }

    //Log in user
    public function connexion()
    {
        if ($this->session->userdata("est_co")) {
            redirect("accueil");
        }

        $data["titre"] = "Connexion";

        $this->form_validation->set_rules("pseudo", "Userame", "required");
        $this->form_validation->set_rules(
            "mot_de_passe",
            "Password",
            "required"
        );

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header");
            $this->load->view("utilisateurs/connexion", $data);
            $this->load->view("templates/footer");
        } else {
            //Get pseudo
            $pseudo = $this->input->post("pseudo");
            //Get and encrypt the mot_de_passe
            $mot_de_passe = md5($this->input->post("mot_de_passe"));

            var_dump($mot_de_passe);
            var_dump($pseudo);

            //Login user
            $id_utilisateur = $this->Utilisateur_model->connexion(
                $pseudo,
                $mot_de_passe
            );

            if ($id_utilisateur) {
                //Create session
                $user_data = [
                    "id_utilisateur" => $id_utilisateur,
                    "pseudo" => $pseudo,
                    "est_co" => true,
                ];

                $this->session->set_userdata($user_data);

                //Set message
                $this->session->set_flashdata(
                    "utilisateur_connecte",
                    "Vous êtes connectés."
                );
                redirect("sondages");
            } else {
                //Set message
                $this->session->set_flashdata(
                    "connexion_echoue",
                    'Les identifiants saisis n\'ont pas permis de vous identifier.'
                );
                redirect("utilisateurs/connexion");
            }
        }
    }

    //Log user out
    public function deconnexion()
    {
        //Unset user data
        $this->session->unset_userdata("est_co");
        $this->session->unset_userdata("id_utilisateur");
        $this->session->unset_userdata("pseudo");

        $this->session->set_flashdata(
            "utilisateur_deconnecte",
            "Vous êtes déconnectés"
        );
        redirect("accueil");
    }

    //Check if pseudo exists
    public function check_pseudo_exists($pseudo)
    {
        $this->form_validation->set_message(
            "check_pseudo_exists",
            'Ce nom d\'utilisateur existe déjà. Choisissez-en un autre.'
        );
        if ($this->Utilisateur_model->check_pseudo_exists($pseudo)) {
            return true;
        } else {
            return false;
        }
    }

    //Check if email exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message(
            "check_email_exists",
            "Cette adresse Email a déjà été utilisée. Choisissez-en une autre."
        );
        if ($this->Utilisateur_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    //Check mot_de_passe size
    public function check_mot_de_passe_size($mot_de_passe)
    {
        $this->form_validation->set_message(
            "check_mot_de_passe_size",
            "Le mot de passe doit contenir au minimun 6 caractères."
        );
        if (strlen($mot_de_passe) >= 6) {
            return true;
        } else {
            return false;
        }
    }
}
