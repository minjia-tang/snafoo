<?php
class Shoppinglist extends CI_Controller {
    public function index($page = 'shoppinglist')
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
        $query = $this->db->query("SELECT s.* FROM sna_foo s WHERE s.optional = 'false'");
        $result1 = $query->result();
        $result1_count = count($result1); 
        $addtional_count = 10 - $result1_count;
        $query = $this->db->query("SELECT sf.* FROM sna_foo sf, sna_vote sv WHERE sf.id = sv.vote_sna_id AND sv.vote_month = '{$vote_month}' ORDER BY sv.vote_count DESC LIMIT {$addtional_count}");
        $result2 = $query->result();
        $data['shoppinglist_sna'] = array_merge($result1,$result2);
                        
        
        $this->load->helper('url');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }        
}


