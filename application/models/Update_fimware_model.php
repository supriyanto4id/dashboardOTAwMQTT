<?php
class Update_fimware_model extends CI_Model
{
    public  $tabel ='file_bin';
    // public  $id ='id_file';

        public function __construct()
        {
                $this->load->database();
        }


        public function get_penguna()
        {
                $query = $this->db->get('penguna');
                return $query->result_array();
        }
        public function get_file_bin()
        {
                $query = $this->db->get('file_bin');
                return $query->result_array();
        }
        public function get_topic()
        {
                $query = $this->db->get('device_iot');
                return $query->result_array();
        }


            // insert data file bin
        function insert_file_bin($data)
        {
            $this->db->insert('file_bin', $data);
        }

        // update data id penguna
    function update($id,$data)
    {
        $this->db->where('id_penguna',$id);
        $this->db->update('penguna',$data);
    }

      // get data by id
        function get_by_id($id)
        {
            $this->db->where('id_file', $id);
            return $this->db->get('file_bin')->row();
        }

        // function get_file_bin_byid_penguna($id)
        // {
        //     $this->db->where('id_penguna', $id);
        //     return $this->db->get('file_bin')->row();
        // }

        // get data by id
          function get_pengguna_byid($id)
          {
              $this->db->where('id_penguna', $id);
              return $this->db->get('penguna')->row();
          }

      // delete file file bin
        function deletefile($id)
        {
            $this->db->where('id_file', $id);
            $this->db->delete('file_bin');
        }

        function insert_device_iot($data)
        {
            $this->db->insert('device_iot', $data);
        }

        function get_by_id_deviceiot($id)
        {
            $this->db->where('id_penguna', $id);
            return $this->db->get('device_iot')->row();


        }

        public function get_device_for_index($id) {
            $query = $this->db->query("SELECT * FROM device_iot where id_penguna=$id");
            return $query->result();
        }
        public function get_pengguna_for_index($id) {
            $query = $this->db->query("SELECT * FROM penguna where id_penguna=$id");
            return $query->result();
        }
        public function get_filebin_for_index($id) {
            $query = $this->db->query("SELECT * FROM file_bin where id_penguna=$id");
            return $query->result();
        }

        function insert_device($data)
        {
            $this->db->insert('device_iot', $data);
        }

        function delete_device($id)
        {
        $this->db->where('id_device', $id);
        $this->db->delete('device_iot');
        }

        function get_device_byid($id)
        {
            $this->db->where('id_device', $id);
            return $this->db->get('device_iot')->row();
        }

        function update_device_iot($id,$data)
        {
            $this->db->where('id_device',$id);
            $this->db->update('device_iot',$data);
        }
}
