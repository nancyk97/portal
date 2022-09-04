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
        $this->template_file_name = 'certificate.docx';
        $this->fileName = "results_" . rand(111111, 999999) . ".docx";
        $this->folder = 'documents';
        $this->full_path = $this->folder . "/" . $this->fileName;
        $this->zip_val = new ZipArchive;
    }

    function generateDocument()
    {
        try {
            if (!file_exists($this->folder)) {
                mkdir($this->folder, 0777, true);
            }
            copy($this->template_file_name, $this->full_path);
            if ($this->zip_val->open($this->full_path) == true) {
                $key_file_name = 'word/document.xml';
                $message = $this->zip_val->getFromName($key_file_name);
                $timestamp = date('d-M-Y H:i:s');
                $message = str_replace("username", "Nancy KhaKhaKhar", $message);
                $this->zip_val->addFromString($key_file_name, $message);
                $this->zip_val->close();
            }
            return $this->full_path;
        } catch (Exception $exc) {
            return "Error creating the Word Document";
        }
    }
}
