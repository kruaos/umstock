<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model("Product_model");
    $this->load->library("pagination");
  }
  public function index(){
    $config = array();
        $config["base_url"] = base_url() . "product/index";
        $config["total_rows"] = $this->Product_model->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 6;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Product_model->
            fetch_product($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view("product", $data);
  }
}
?>