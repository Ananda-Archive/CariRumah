<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Products_Image extends CI_Model {
    const TABLE_NAME = 'products_image';

    public function create($product_id, $images) {
        foreach ($images as $image) {
            $this->db->insert($this::TABLE_NAME, array(
                'product_id' => $product_id,
                'image' => $image
            ));
        }
        return $this->db->insert_id();
    }

    public function get_by_id($id) {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("product_id='{$id}'");
        return $this->db->get()->result_array();
    }

    public function update($product_id, $images) {
        $this->db->where('product_id', $product_id);
        $this->db->delete($this::TABLE_NAME);

        foreach ($images as $image) {
            $this->db->insert($this::TABLE_NAME, array(
                'product_id' => $product_id,
                'image' => $image
            ));
        }

        return $this->db->affected_rows();
    }
}

?>