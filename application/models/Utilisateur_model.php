
<?php class Utilisateur_model extends CI_Model
{
    public function inscription($enc_mot_de_passe)
    {
        // User data array
        $data = [
            "nom" => $this->input->post("nom", true),
            "prenom" => $this->input->post("prenom", true),
            "email" => $this->input->post("email", true),
            "pseudo" => $this->input->post("pseudo", true),
            "mot_de_passe" => $enc_mot_de_passe,
        ];
        //Insert user
        return $this->db->insert("utilisateur", $data);
    }

    //Log user in
    public function connexion($pseudo, $mot_de_passe)
    {
        //Validate
        $this->db->where("pseudo", $pseudo);
        $this->db->where("mot_de_passe", $mot_de_passe);

        $result = $this->db->get("utilisateur");

        if ($result->num_rows() == 1) {
            return $result->row(0)->idu;
        } else {
            return false;
        }
    }

    //Check user exists
    public function check_pseudo_exists($pseudo)
    {
        $query = $this->db->get_where("utilisateur", ["pseudo" => $pseudo]);
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    //Check email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where("utilisateur", ["email" => $email]);
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
}
