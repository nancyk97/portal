<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<form id="manage-candidate" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-12">
					<label for="" class="control-label">Candidate Adhar Number</label>
					<input type="number" class="form-control" for="aadhar_number" id="adhar_number" name="aadhar_number" onchange="TestOnTextChange()" required="" value="">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="" class="control-label">Last Name</label>
					<input type="text" class="form-control" name="lastname" id='lastname' required="" value="<?php echo isset($lastname) ? $lastname : ''  ?>">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">First Name</label>
					<input type="text" class="form-control" name="firstname" required="" value="<?php echo isset($firstname) ? $firstname : ''  ?>">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Middle Name</label>
					<input type="text" class="form-control" name="middlename" required="" value="<?php echo isset($middlename) ? $middlename : ''  ?>">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="" class="control-label">Date Of Birth</label>
					<input type="date" class="input-group-text" id="birthday" for="birthday" name="birthday">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Email</label>
					<input type="email" class="form-control" name="email" for="email" required="" value="<?php echo isset($email) ? $email : ''  ?>">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Contact</label>
					<input type="text" class="form-control" name="contact" for="contact" required="" value="<?php echo isset($contact) ? $contact : ''  ?>">
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-12">
					<label for="" class="control-label">Qualification </label>
					<input type="text" class="form-control" id="qualification" name="qualification"  required="" value="">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="input-group col-md-12 mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="Profile">Profile</span>
					</div>
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="profile_path" accept="image/*" id="file-input" onchange="imageExtensionValidate(this,$(this))">

						<label class="custom-file-label" for="profile_path" > <?php echo isset($fname) ? $fname : 'Choose file'  ?></label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="" class="control-label">Entry</label>
					<select class="custom-select browser-default" name="en">
						<option value="1">Existing</option>
						<option value="2" selected>New entry</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Cource</label>
					<select class="custom-select browser-default" name="cource_id" id='cource_id'>
						<option value="1" selected>Bolt Torquering & tensioning Traning</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Center</label>
					<select class="custom-select browser-default" name="center_id" id='center_id'>
						<option value="1" selected>ABS Jamnagar</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">

			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="" class="control-label">Designation</label>
					<input type="text" class="form-control" name="designation" id='designation' required="" value="-">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Date Of Validation</label>
					<input type="date" class="input-group-text" id="Validation" for="Validation" name="Validation">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Date Of validity</label>
					<input type="date" class="input-group-text" id="validity" for="validity" name="validity">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">

			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="" class="control-label">Awareness Mark</label>
					<input type="number" class="form-control" name="awareness_mark" id='awareness_mark' required="" value="">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Theory Mark</label>
					<input type="number" class="form-control" name="theory_mark" id="theory_mark" required="" value="">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Practical Mark</label>
					<input type="number" class="form-control" name="practical_mark" id ="practical_mark" required="" value="">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="" class="control-label">Remark</label>
					<input type="text" class="form-control" name="remark" id='remark' required="" value="-">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Result</label>
					<input type="text" class="form-control" name="result" for='result' required="" value="pass">
				</div>
				<div class="col-md-4">
					<label for="" class="control-label">Result Date</label>
					<input type="date" class="input-group-text" id="result_date" for="result_date" name="result_date">
				</div>
			</div>
		</div>
		<!-- <div class="row form-group">
			<div class="col-md-6">
				<label for="" class="control-label">Status</label>
				<select class="custom-select browser-default select2" name="status">
					<option value="0" selected>New</option>
				</select>
			</div>
		</div> -->


	</form>
</div>

<script type="text/javascript">
	function TestOnTextChange() {
		var adhar_number = $('#adhar_number').val();
		$.ajax({
			url: 'ajax.php?action=check_existing_candidate',
			method: 'POST',
			datatype: "json",
			data: {
				adhar_number: adhar_number
			},
			success: function(resp) {
				if (resp == 1) {
					alert('candidate registred allready Please serarch on list page.')
					setTimeout(function() {
						location.reload()
					}, 1000)
				}
			}
		});
	}

	function imageExtensionValidate(i, _this) {
		var validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
		// var fileInput = document.getElementsById("file-input");
		var fileVal = i.value;
		if (fileVal.length > 0) {
			var blnValid = false;
			for (var j = 0; j < validFileExtensions.length; j++) {
				var sCurExtension = validFileExtensions[j];
				if (fileVal.substr(fileVal.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
					blnValid = true;
					break;
				}
			}

			if (!blnValid) {
				alert("Sorry, " + fileVal + " is invalid, allowed extensions are: " + validFileExtensions.join(", "));
				return false;
			} else {
				if (i.files && i.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						console.log(i.files[0].name)
						_this.siblings('label').html(i.files[0].name);
					}
					reader.readAsDataURL(i.files[0]);
				}
			}
		}
	}

	$(document).ready(function() {
		$('.select2').select2({
			width: "100%",
			placeholder: 'Please select here'
		})
		$('#manage-candidate').submit(function(e) {
			e.preventDefault()
			start_load();
			$.ajax({
				url: 'ajax.php?action=save_candidate',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				error: err => {
					console.log(err)
				},
				success: function(resp) {
					if (resp == 1) {
						alert_toast('candidate registred successfully submitted.', 'success')
						setTimeout(function() {
							location.reload()
						}, 1000)
					}
				}
			})

		})
	})
</script>