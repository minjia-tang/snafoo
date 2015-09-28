<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggestions extends CI_Controller {
    public function index($page="suggestions")
    {
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        } 
        $this->load->database();
        $d = new DateTime(); 
        $vote_month = $d->format( 'Y-m-t' ); 
        if (!empty($_COOKIE['SUGGESTION'])) {
            $data['suggestion'] = $_COOKIE['SUGGESTION'];
        } else {
            $data['suggestion'] = "false";
        } 
        
        if(!empty($_POST['submitted']) && $_POST['submitted']== "true") {
             $message = "<p style=\"color: red;\">Thank you!</p>";
            if($_POST['snackOptions'] !=0) {
                $insert_suggested_sna_id = $_POST['snackOptions'];
                $query = $this->db->query("SELECT * FROM sna_vote 
                                            WHERE vote_sna_id={$insert_suggested_sna_id}
                                            AND vote_month = '{$vote_month}'");
                $data['vote_sna'] = $query->result();
                $result_count = count($data['vote_sna']);
                if ($result_count>0){
                    $sql = "UPDATE sna_vote SET vote_count = vote_count+1 WHERE vote_sna_id = {$insert_suggested_sna_id} AND vote_month = '{$vote_month}'";                    
                } else {
                    $sql = "INSERT INTO sna_vote (vote_month,vote_sna_id,vote_count) VALUES ('{$vote_month}','{$insert_suggested_sna_id}',1);";
                }               
                $this->db->query($sql);              
                setcookie("SUGGESTION", "true", strtotime("first day of next month 0:00"));
                $data['suggestion'] = "true";    
            } else {
                if (!empty($_POST['suggestionInput']) && !empty($_POST['suggestionLocation'])) {
                    $query = $this->db->query("SELECT * FROM sna_foo WHERE  name = '{$_POST['suggestionInput']}'");
                    $check_results = $query->result();
                    $check_result_count = count($check_results); 
                    if ($check_result_count>0){
                        $message = "<p style=\"color: red;\">You entered a duplicated snack, it either on suggeston list or on vote list</p>";
                        setcookie("SUGGESTION", "false", strtotime("first day of next month 0:00"));
                        $data['suggestion'] = "false";
                    } else {
                        $sql = "INSERT INTO sna_foo (name,optional, purchaseCount, purchaseLocations) VALUES ('{$_POST['suggestionInput']}','optional', 0, '{$_POST['suggestionLocation']}');";
                        $this->db->query($sql);
                        $new_sna_id = $this->db->insert_id();
                        $sql = "INSERT INTO sna_vote (vote_month,vote_sna_id,vote_count) VALUES ('{$vote_month}','{$new_sna_id}',1);";
                        $this->db->query($sql);
                        setcookie("SUGGESTION", "true", strtotime("first day of next month 0:00"));
                        $data['suggestion'] = "true";                           
                    }                                  
                } else {
                    $message = "<p style=\"color: red;\">Some fields are missing.</p>";                    
                    setcookie("SUGGESTION", "false", strtotime("first day of next month 0:00"));
                    $data['suggestion'] = "false";               
                }
            }
            $data['msg'] = $message;    
        }        
              
        $query = $this->db->query("SELECT sf.* FROM sna_foo sf WHERE optional = 'true' and id NOT IN (SELECT vote_sna_id FROM sna_vote WHERE vote_month = '{$vote_month}');");
        $data['suggest_sna'] = $query->result();
                       
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->helper('url');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }  
}


