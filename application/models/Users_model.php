<?
class Users_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function fetch_user_login($username,$password){
        $this->db->select('user_id,u_username,u_role');
        $this->db->where('u_username',$username);
        $this->db->where('u_password',$password);
        $query = $this->db->get('users',1);
        return $query->row();
    }
    public function create_user($username,$password){
        if($username && $password){
            $this->db->select('*');
            $this->db->where('u_username',$username);
            $query = $this->db->get('users',1);
            // return $query->num_rows();
    
            $data = array();
            if($query->num_rows() > 0){
                $this->session->set_flashdata('err_message', 'Username is already !');
            }else{
                $dataRegister = array(
                    'u_username' => $username,
                    'u_password' => $password
                );
                if($this->db->insert('users',$dataRegister)){
                    $this->session->set_flashdata('err_message', 'Signed up successfully !');
                    $data['status'] = '1';
                }else{
                    $data['status'] = '0';
                }
                return $data;
            }
        }else{
            $this->session->set_flashdata('err_message', 'Please enter username & password.');
        }
    }
}
?>