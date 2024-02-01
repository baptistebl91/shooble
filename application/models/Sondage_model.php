<?php

class Sondage_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_sondages($hash_titre = false)
    {
        if ($hash_titre === false) {
            $this->db->order_by("created_at", "DESC");
            $query = $this->db->get_where("sondage", [
                "id_utilisateur" => $this->session->userdata("id_utilisateur"),
            ]);

            return $query->result_array();
        }

        $query = $this->db->get_where("sondage", ["hash_titre" => $hash_titre]);
        return $query->row_array();
    }

    public function create_sondage()
    {
        $hash_titre = md5($this->input->post("titre", true));

        if ($this->input->post("date2", true) == "") {
            $date2 = null;
        } else {
            $date2 = $this->input->post("date2", true);
        }

        if ($this->input->post("heure2", true) == "") {
            $heure2 = null;
        } else {
            $heure2 = $this->input->post("heure2", true);
        }

        if ($this->input->post("date3", true) == "") {
            $date3 = null;
        } else {
            $date3 = $this->input->post("date3", true);
        }

        if ($this->input->post("heure3", true) == "") {
            $heure3 = null;
        } else {
            $heure3 = $this->input->post("heure3", true);
        }
        $data = [
            "titre" => $this->input->post("titre", true),
            "hash_titre" => $hash_titre,
            "description" => $this->input->post("description", true),
            "lieu" => $this->input->post("lieu", true),
            "date1" => $this->input->post("date1", true),
            "heure1" => $this->input->post("heure1", true),
            "date2" => $date2,
            "heure2" => $heure2,
            "date3" => $date3,
            "heure3" => $heure3,
            "id_utilisateur" => $this->session->userdata("id_utilisateur"),
        ];

        return $this->db->insert("sondage", $data);
    }

    public function get_hash()
    {
        return md5($this->input->post("titre", true));
    }

    public function delete_sondage($ids)
    {
        $this->db->where("ids", $ids);
        $this->db->delete("sondage");
        return true;
    }

    public function update_sondage()
    {
        $hash_titre = md5($this->input->post("titre", true));

        if ($this->input->post("date2", true) == "") {
            $date2 = null;
        } else {
            $date2 = $this->input->post("date2", true);
        }

        if ($this->input->post("heure2", true) == "") {
            $heure2 = null;
        } else {
            $heure2 = $this->input->post("heure2", true);
        }

        if ($this->input->post("date3", true) == "") {
            $date3 = null;
        } else {
            $date3 = $this->input->post("date3", true);
        }

        if ($this->input->post("heure3", true) == "") {
            $heure3 = null;
        } else {
            $heure3 = $this->input->post("heure3", true);
        }

        $checkbox_value = $this->input->post("closed", true);
        $closed_survey =
            isset($checkbox_value) && $checkbox_value == "on" ? 1 : 0;

        $data = [
            "titre" => $this->input->post("titre", true),
            "hash_titre" => $hash_titre,
            "description" => $this->input->post("description", true),
            "lieu" => $this->input->post("lieu", true),
            "date1" => $this->input->post("date1", true),
            "heure1" => $this->input->post("heure1", true),
            "date2" => $date2,
            "heure2" => $heure2,
            "date3" => $date3,
            "heure3" => $heure3,
            "closed_survey" => $closed_survey,
            "id_utilisateur" => $this->session->userdata("id_utilisateur"),
        ];

        $this->db->where("ids", $this->input->post("ids", true));
        return $this->db->update("sondage", $data);
    }

    public function get_createur($id_sondage)
    {
        $sql =
            "select pseudo from utilisateur u join sondage s on u.idu = s.id_utilisateur where s.ids = ?";
        $query = $this->db->query($sql, $id_sondage);
        return $query->row();
    }

    public function get_nbr_participants($id_sondage)
    {
        $sql =
            "SELECT count(id_sondage) as nbr from reponse where id_sondage = ?";
        $query = $this->db->query($sql, $id_sondage);
        return $query->row();
    }

    public function get_votes($id_sondage, $creneau)
    {
        $sql =
            "SELECT count(idr) as nbr from reponse where id_sondage=? and creneau=?";
        $query = $this->db->query($sql, [$id_sondage, $creneau]);
        return $query->row();
    }

    public function how_many_sondages($id_utilisateur)
    {
        $sql =
            "select count(ids) as reponse from sondage where id_utilisateur = ? ";
        $query = $this->db->query($sql, $id_utilisateur);
        return $query->row();
    }
}
