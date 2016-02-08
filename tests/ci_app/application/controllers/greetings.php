<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Greetings extends CI_Controller
{
    public function index()
    {
        $this->load->view('greeting_message');
    }
}
