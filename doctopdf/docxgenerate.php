<?php
require('htmltopdf.php');

class html2pdf
{

    public $template_file_name;
    public $fileName;
    public $full_path;
    public $folder;
    public $zip_val;
    function __construct()
    {
        ob_start();
        include 'db_connect.php';
        $this->db = $conn;
        $this->template_file_name = 'certificate.docx';
        $this->fileName = "results_" . rand(111111, 999999) . ".docx";
        $this->folder = 'documents';
        $this->full_path = $this->folder . "/" . $this->fileName;
        $this->zip_val = new ZipArchive;
    }

    function generateDocument($candidate_id)
    {
        $qry = $this->db->query("SELECT * FROM candidate c INNER JOIN candidate_course cc on c.id = cc.candidate_id where id = " . $candidate_id);
        while ($rows = $qry->fetch_assoc()) {
            print_r($rows);
            die;
        }

        // $query = $this->db->query("SELECT * FROM candidate_course where candidate_id = " . $candidate_id)->fetch_array();
        // while ($rowcc = $query->fetch_assoc()) {
        //     print_r($rowcc);
        //     die;
        // }

        $name = $rows['firstname'] . " " .$rows['middlename']. " ". $rows['lastname'];

        $total  = $rows['awareness_mark'] + $rows['theory_mark']+$rows['practical_mark'];
        $awareness_mark =$rows['firstname'];
        $theory_mark = $rows['theory_mark'];
        $practical_mark = $rows['practical_mark'];


        try {
            if (!file_exists($this->folder)) {
                mkdir($this->folder, 0777, true);
            }
            copy($this->template_file_name, $this->full_path);
            if ($this->zip_val->open($this->full_path) == true) {
                $key_file_name = 'word/document.xml';
                $message = $this->zip_val->getFromName($key_file_name);
                $timestamp = date('d-M-Y H:i:s');
                $message = str_replace("username", $name, $message);
                $message = str_replace("userdesignation", $rows['designation'], $message);
                $message = str_replace("usercourse", "Bolt Torquering & tensioning Traning", $message);
                $message = str_replace("userSAmarks", $awareness_mark, $message);
                $message = str_replace("userthmarks", $theory_mark, $message);
                $message = str_replace("userpmarks", $practical_mark, $message);
                $message = str_replace("usertotalmarks", $total, $message);



                $this->zip_val->addFromString($key_file_name, $message);
                $this->zip_val->close();
            }
            return $this->full_path;
        } catch (Exception $exc) {
            return "Error creating the Word Document";
        }
    }
}
