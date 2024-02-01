<?php
class Reponse_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_reponse($id_sondage, $pseudo)
    {
        $data = [
            "creneau" => $this->input->post("creneau"),
            "id_sondage" => $id_sondage,
            "description" => $this->input->post("description", true),
            "pseudo" => $pseudo,
            "id_createur" => $this->session->userdata("id_utilisateur"),
        ];
        return $this->db->insert("reponse", $data);
    }

    public function get_reponses($id_sondage)
    {
        $this->db->order_by("idr", "DESC");
        $query = $this->db->get_where("reponse", ["id_sondage" => $id_sondage]);
        return $query->result_array();
    }

    public function get_number_rep($id_createur, $id_sondage)
    {
        $sql =
            "select count(id_createur) as test from reponse where id_createur = ? and id_sondage = ?";
        $query = $this->db->query($sql, [$id_createur, $id_sondage]);
        return $query->row();
    }

    public function get_votes($id_sondage)
    {
    }
}
