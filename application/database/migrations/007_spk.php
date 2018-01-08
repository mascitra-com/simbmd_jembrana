<?php
class Migration_spk extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 11,'auto_increment' => TRUE),
            'nomor' => array('type' => 'VARCHAR','constraint' => 255),
            'tanggal' => array('type' => 'DATETIME'),
            'uraian_pekerjaan' => array('type' => 'VARCHAR','constraint'=>255,'default'=>NULL),
            'nama_rekanan' => array('type' => 'VARCHAR','constraint'=>255,'default'=>NULL),
            'alamat_rekanan' => array('type' => 'VARCHAR','constraint'=>255,'default'=>NULL),
            'nilai' => array('type' => 'BIGINT','default'=>NULL),
            'addendum_nomor' => array('type' => 'VARCHAR','constraint' => 255,'default'=>NULL),
            'addendum_tanggal' => array('type' => 'DATETIME','default'=>NULL),
            'addendum_uraian_pekerjaan' => array('type' => 'VARCHAR','constraint'=>255,'default'=>NULL),
            'addendum_nilai' => array('type' => 'BIGINT','default'=>NULL),
            'id_organisasi' => array('type' => 'INT','constraint' => 11),
            'id_kegiatan' => array('type' => 'INT','constraint' => 11),
            'log_action' => array('type' => 'VARCHAR','constraint'=>255,'default'=>null),
            'log_user' => array('type' => 'VARCHAR','constraint'=>255,'default'=>null),
            'log_time' => array('type' => 'DATETIME','default'=>null),
            'is_deleted' => array('type' => 'TINYINT','constraint'=>1,'default'=>0)
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('spk');
    }

    public function down() {
        $this->dbforge->drop_table('spk');
    }
}