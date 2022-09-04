<?php include('db_connect.php');?>
<?php
// $qry = $conn->query("SELECT * FROM vacancy ");
// 	while($row=$qry->fetch_assoc()){
// 		$pos[$row['id']] = $row['position'];
// 	}
// 	$pid = 'all';
// 	if(isset($_GET['pid']) && $_GET['pid'] >= 0){
// 		$pid = $_GET['pid'];
// 	}
// 	$position_id = 'all';
// 	if(isset($_GET['position_id']) && $_GET['position_id'] >= 0){
// 		$position_id = $_GET['position_id'];
// 	}
?>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">

			<!-- Table Panel -->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-12">
								<span><large><b>Candidate List</b></large></span>
								<button class="btn btn-sm btn-block btn-primary btn-sm col-md-2 float-right" type="button" id="new_canddate"><i class="fa fa-plus"></i> New Canddate</button>
							</div>
						</div>
						
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-md-5">
									
									</div>
								</div>
							</div>
						</div>
						<hr><br>
						<table class="table table-bordered table-hover">
							<colgroup>
								<col width="10%">
								<col width="30%">
								<col width="20%">
								<col width="30%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Candidate Information</th>
									<th class="text-center">Adhar Number</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$candidates = $conn->query("SELECT * FROM candidate c where deleted !=1 order by c.id asc");
								while($row=$candidates->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Name : <b><?php echo ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?></b></p>
										<p>Email : <b><?php echo $row['email'] ?></b></p>
										<p>Contact Number : <b><?php echo $row['contact'] ?></b></p>
									</td>
									<td class="text-center">
										<?php echo $row['aadhar_number'] ?>
									</td>
									<td class="text-center">
										<!-- <button class="btn btn-sm btn-primary view_application" type="button" data-id="<?php 
										// echo $row['id'] ?>" >View</button> -->
										<!-- <button class="btn btn-sm btn-primary edit_application" type="button" data-id="<?php 
										// echo $row['id'] ?>" >Edit</button> -->
										<!-- <button class="btn btn-sm btn-danger delete_application" type="button" data-id="<?php 
										// echo $row['id'] ?>">Delete</button> -->
										<button class="btn btn-sm btn-success download_certificate" type="button" data-id="<?php echo $row['id'] ?>">Download</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height :150px;
	}
</style>
<script>
	// $('.filter_status').each(function(){
	// 	if($(this).attr('data-id') == '')
	// 		$(this).addClass('btn-primary')
	// 	else
	// 		$(this).addClass('btn-info')

	// })
	$('table').dataTable()
	$("#new_canddate").click(function(){
		uni_modal("Candidate registration","manage_candidate.php","mid-large")
	})
	$(".edit_candidate").click(function(){
		uni_modal("Edit Candidate","manage_candidate.php?id="+$(this).attr('data-id'),"mid-large")
	})
	$(".view_candidate").click(function(){
		uni_modal("","view_candidate.php?id="+$(this).attr('data-id'),"mid-large")
	})

	$('.delete_candidate').click(function(){
		_conf("Are you sure to delete this candidate?","delete_candidate",[$(this).attr('data-id')])
	})
	$('.download_certificate').click(function(){
		download_certificate($(this).attr('data-id'));
	})
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

	function delete_application($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_application',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	function download_certificate($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=download_certificate',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                window.location.assign(resp)
                // if(resp!=''){
                //     alert_toast("Data successfully downloaded",'success')
                //     setTimeout(function(){
                //         location.reload()
                //     },1500)
                // }
            }
        })
    }
</script>