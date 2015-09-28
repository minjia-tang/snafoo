<?php
class Home extends CI_Controller {
    public function index($page = 'home')
    {
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }  
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->database();
        $d = new DateTime(); 
        $vote_month = $d->format( 'Y-m-t' ); 
        
        if (!empty($_COOKIE['VOTES'])) {
            $votes = unserialize($_COOKIE['VOTES']);
        }  
               
        if(!empty($_POST['submitted']) && $_POST['submitted']== "true") {
            $update_vote_sna_id = $_POST['sna_id'];
            $sql = "UPDATE sna_vote SET vote_count = vote_count+1 WHERE vote_sna_id = {$update_vote_sna_id} AND vote_month = '{$vote_month}'";
            $this->db->query($sql);  

            if (!empty($_COOKIE['VOTES'])) {
                $votes = unserialize($_COOKIE['VOTES']);
            } 
            $votes[] = $update_vote_sna_id;

            setcookie("VOTES", serialize($votes), strtotime("first day of next month 0:00"));               
        }
        if(empty($votes))  { $votes=array();}
        $data['total_votes'] = count($votes);  
        $data['votes'] = $votes;     

        
        
        $query = $this->db->query("SELECT * FROM sna_foo WHERE optional = 'false'");
        $data['always_sna'] = $query->result();

        $query = $this->db->query("SELECT sv.*, sf.name, sf.lastPurchaseDate FROM sna_vote sv, sna_foo sf
                                    WHERE vote_sna_id=sf.id
                                    AND vote_month = '{$vote_month}'");
        $data['vote_sna'] = $query->result();
        $data['result_count'] = count($data['vote_sna']);
        

        
        $this->load->helper('url'); 
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }            
}


