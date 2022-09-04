<?php
session_start();
ini_set('display_errors', 1);
include 'doctopdf/docxgenerate.php';

class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;

		
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . $password . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function login2()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $email . "' and password = '" . md5($password) . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user()
	{
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set " . $data);
		} else {
			$save = $this->db->query("UPDATE users set " . $data . " where id = " . $id);
		}
		if ($save) {
			return 1;
		}
	}
	function signup()
	{
		extract($_POST);
		$data = ", firstname = '$firstname'";
		$data .= ", middlename = '$middlename'";
		$data .= ", lastname = '$lastname'";
		$data .= ", email = '$email'";
		$data .= ", contact = '$contact'";
		$data .= ", employer_id = '1";
		$data .= ", qualification = '$qualification'";
		$data .= ", center_id = '$center_id'";
		$data .= ", profile_path = '$profile_path'";
		$data .= ", designation_id = '$designation_id'";
		$data .= ", date_created = '$date_created'";
		$data .= ", date_modified = '$date_modified'";
		$data .= ", aadhar_number = '$aadhar_number'";
		// $data .= ", status = '0'";

		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		$save = $this->db->query("INSERT INTO users set " . $data);
		if ($save) {
			$qry = $this->db->query("SELECT * FROM users where username = '" . $email . "' and password = '" . md5($password) . "' ");
			if ($qry->num_rows > 0) {
				foreach ($qry->fetch_array() as $key => $value) {
					if ($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_' . $key] = $value;
				}
			}
			return 1;
		}
	}

	function save_settings()
	{
		extract($_POST);
		$data = " name = '" . str_replace("'", "&#x2019;", $name) . "' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '" . htmlentities(str_replace("'", "&#x2019;", $about)) . "' ";
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/img/' . $fname);
			$data .= ", cover_img = '$fname' ";
		}

		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE system_settings set " . $data);
		} else {
			$save = $this->db->query("INSERT INTO system_settings set " . $data);
		}
		if ($save) {
			$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
			foreach ($query as $key => $value) {
				if (!is_numeric($key))
					$_SESSION['setting_' . $key] = $value;
			}

			return 1;
		}
	}


	function save_recruitment_status()
	{
		extract($_POST);
		$data = " status_label = '$status_label' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO recruitment_status set " . $data);
		} else {
			$save = $this->db->query("UPDATE recruitment_status set " . $data . " where id=" . $id);
		}
		if ($save)
			return 1;
	}
	function delete_recruitment_status()
	{
		extract($_POST);
		$delete = $this->db->query("UPDATE recruitment_status set status = 0 where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_vacancy()
	{
		extract($_POST);
		$data = " position = '$position' ";
		$data .= ", availability = '$availability' ";
		$data .= ", description = '" . htmlentities(str_replace("'", "&#x2019;", $description)) . "' ";
		if (isset($status))
			$data .= ", status = '$status' ";

		if (empty($id)) {

			$save = $this->db->query("INSERT INTO vacancy set " . $data);
		} else {
			$save = $this->db->query("UPDATE vacancy set " . $data . " where id=" . $id);
		}
		if ($save)
			return 1;
	}
	function delete_vacancy()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM vacancy where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_candidate()
	{
		extract($_POST);
		$data = "firstname = '$firstname'";
		$data .= ", middlename = '$middlename'";
		$data .= ", lastname = '$lastname'";
		$data .= ", email = '$email'";
		$data .= ", contact = '$contact'";
		$data .= ", employer_id = '1'";
		$data .= ", qualification = '$qualification'";
		$data .= ", center_id = '$center_id'";
		$data .= ", designation = '$designation'";

		$data .= ", aadhar_number = '$aadhar_number'";
		$data .= ", status = '0'";
		if ($_FILES['profile_path']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['profile_path']['name'];
			$move = move_uploaded_file($_FILES['profile_path']['tmp_name'], 'assets/profile/' . $fname);
			$data .= ", profile_path = '$fname' ";
		} else {
			$data .= ", profile_path = 'user.jpg' ";
		}
		$date = date('Y:m:d h:i:s', time());
		$data .= ", date_modified = '$date'";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO candidate set " . $data);
		} else {
			$save = $this->db->query("UPDATE candidate set " . $data . " where id=" . $id);
		}
		if ($save) {
			$qry = $this->db->query("SELECT * FROM candidate where aadhar_number = '" . $aadhar_number ."' limit 1")->fetch_array();
			foreach ($qry as $key => $value) {
				if ($key == 'id')
					$candidate_id = $value;
			}
			$data_cc = " candidate_id = ' $candidate_id'";
			$data_cc .= ", course_id = ' $cource_id'";
			$data_cc .= ", start_date = ' $Validation'";
			$data_cc .= ", validity_date = ' $validity'";
			$data_cc .= ", deleted = ' 0'";
			$data_cc .= ", awareness_mark = ' $awareness_mark'";
			$data_cc .= ", theory_mark = ' $theory_mark'";
			$data_cc .= ", practical_mark = ' $practical_mark'";
			$data_cc .= ", remark = ' $remark'";
			$data_cc .= ", result = ' $result'";
			$data_cc .= ", result_date = ' $result_date'";

			$save_cc = $this->db->query("INSERT INTO candidate_course set " . $data_cc);
			return 1;
		} else {
			return 0;
		}
	}
	function delete_candidate()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM candidate where id = " . $id);
		if ($delete)
			return 1;
	}
	function check_existing_candidate()
	{
		extract($_POST);
		$status = 0;
		$qry = $this->db->query("SELECT * FROM candidate where aadhar_number = " . $adhar_number);
		while ($rows[] = mysqli_fetch_assoc($qry)) {
			$status = 1;
		}
		return $status;
	}

	function download_certificate($candidateid)
	{
		$doc_name = new html2pdf();
		$path = $doc_name->generateDocument($candidateid);
		return $path;
	}
}
