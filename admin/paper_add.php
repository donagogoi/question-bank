<?php 
	$core = Core::getInstance();


	$error = '';

	if(isset($_POST['submit'])){
		

		$paper_code = addslashes(strip_tags(trim($_POST['paper_code'])));
		$paper_name = addslashes(strip_tags(trim($_POST['paper_name'])));
		$degree_name = addslashes(strip_tags(trim($_POST['degree_name'])));
		$course_type = addslashes(strip_tags(trim($_POST['course_type'])));
    	$year = addslashes(strip_tags(trim($_POST['year'])));




    	// file operations

    	 if ($_FILES["fileToUpload"]["name"] != "") {

                $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                $newfilename = $paper_code.'_'. rand() . '.' . end($temp);
                
                $target_dir = "uploads/";

                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if file already exists
                if (file_exists($target_file)) {
                    //echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf" ) {
                    //echo "Sorry, only JPG, JPEG, PNG & GIF & Pdf files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $error = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
                        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                         $img_path = $target_dir.$newfilename;
                    } else {
                        $error = "Sorry, there was an error uploading your file.";
                    }
                }

               
            
            }else{
                $img_path = "";
            }

            if($img_path != ""){
            	$q = "INSERT INTO question_paper (paper_code,paper_name,degree_name,course_type,year, file) VALUES(:paper_code,:paper_name,:degree_name,:course_type,:year, :file)";
				$stmt = $core->dbh->prepare($q);
				$stmt->bindParam(':paper_code',$paper_code, PDO::PARAM_STR);
				$stmt->bindParam(':paper_name',$paper_name, PDO::PARAM_STR);
				$stmt->bindParam(':course_type',$course_type, PDO::PARAM_STR);
				$stmt->bindParam(':degree_name',$degree_name, PDO::PARAM_STR);
				$stmt->bindParam(':year',$year, PDO::PARAM_STR);
				$stmt->bindParam(':file',$img_path, PDO::PARAM_STR);
				if($stmt->execute()){
					echo '<script>alert("Successfully Submitted")</script>';	
				}else{
					echo '<script>alert("Something Went Wrong ")</script>';
				}
            }else{
            	echo '<script>alert("'.$error.'")</script>';
            }
    	

		
	}



	// for delete

	if(isset($_GET['sl_no'])){
		$paper_id = addslashes(strip_tags(trim($_GET['sl_no'])));

		// to delete this file
		$q2 = "SELECT * FROM question_paper WHERE paper_id=:paper_id";
		$stmt2 = $core->dbh->prepare($q2);
		$stmt2->bindParam(':paper_id',$paper_id, PDO::PARAM_INT);
		$stmt2->execute();
		if($stmt2->execute()){
			$row2 = $stmt2->fetchObject(); // data fetch
			if($row2->file != NULL && $row2->file != ''){
				// we will delete now
				if(file_exists($row2->file)){
					unlink($row2->file);
				}
			}
		}

		$q = "DELETE FROM question_paper WHERE paper_id=:paper_id";
		$stmt = $core->dbh->prepare($q);
		$stmt->bindParam(':paper_id',$paper_id, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->execute()){
					echo '<script>alert("Successfully Deleted")</script>';	
					echo '<script>window.location.href="http://localhost/question-bank/paper_master.php"</script>';	
				}else{
					echo '<script>alert("Something Went Wrong ")</script>';
					echo '<script>window.location.href="http://localhost/question-bank/paper_add.php"</script>';
				}

	}

?>
<div class="container p-3">
	<h4>Paper Master</h4>

	<!-- Add Button -->
	<button class="btn btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Add New Paper</button>


	<!-- Modal -->
	<form method="post" enctype="multipart/form-data">
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add New Paper</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="form-group">
				<label for="exampleInputEmail1">Paper code</label>
				<input type="text" class="form-control" name="paper_code" placeholder="Paper Code" required="required">
	
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Paper name</label>
				<input type="text" name="paper_name" class="form-control" placeholder="Paper Name" required="required">
			</div>
			<div class="row">
		<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
			<div class="form-group">
				<label for="exampleInputPassword1">Degree name</label>
				<input type="text" name="degree_name" class="form-control" placeholder="Degree" required="required">
			</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
				<div class="form-group">
				<label for="exampleInputPassword1">Course Type</label>
				<select class="form-control" name="course_type" required="required">
					<option>Select</option>
					<option value="REGULAR">REGULAR</option>
					<option value="COMPARTMENTAL">COMPARTMENTAL</option>
				</select>
			</div>

			</div>
			<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
				<div class="form-group">
				<label for="exampleInputPassword1">Year</label>
				<input type="text" name="year" class="form-control" placeholder="Year" required="required">
			</div>
			</div>

			<div class="form-group p-3">
				<label for="exampleInputPassword1">Add file</label>
				<input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required="required">
			</div>
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
</form>

	<!-- Table -->

<br />

	<table class="table table-bordered">
		<thead>
			<tr>
				<td width="5%">Sl.no</td>
				<td width="15%">Paper Code</td>
				<td width="30%">Paper Name</td>
				<td width="15%">Degree</td>
				<td width="10%">Paper Type</td>
				<td width="10%">Years</td>
				<td width="10%">File</td>
				
				<td width="5%">Delete</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$q1 = "SELECT * FROM question_paper ORDER BY paper_id desc";
			$stmt = $core->dbh->prepare($q1);
			$stmt->execute();
			
			if($stmt->rowCount() > 0){
				$index=1;
				while($row = $stmt->fetchObject()){
					
					?>
					<tr>
						<td><?php echo $index; ?></td>
						<td><?php echo $row->paper_code; ?></td>
						<td><?php echo $row->paper_name; ?></td>
		
						<td><?php echo $row->degree_name; ?></td>
						<td><?php echo $row->course_type; ?></td>
						<td><?php echo $row->year; ?></td>
						<td><a target="_blank" href="<?php echo $row->file; ?>">View File</a></td>
						
						<td><a onclick="return confirm('Are you sure?')" href="?sl_no=<?php echo $row->paper_id; ?>"><i class="fa fa-trash"></i></a></td>
					</tr>
					<?php 
					$index++;
				}
			}else{
				echo '<tr><td colspan="8">No results found</td></tr>';
			}
			?>
		</tbody>
	</table>
</div>