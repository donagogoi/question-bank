<?php 
	$core = Core::getInstance();


	

	
	?>
<div class="container p-3">
	<h4>Search Paper</h4>
	<form method="post">
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
				<div class="form-group">
				
				<select class="form-control" name="search_by" required="required">
					<option>Search by</option>
					<option value="paper_code">Paper Code</option>
					<option value="paper_name">Paper Name</option>
					<option value="degree_name">Degree</option>
					<option value="course_type">Paper Type</option>
					<option value="year">Year</option>
				</select>
			</div>
			</div>
		<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
			<div class="form-group">
				
				<input type="text" name="search_value" class="form-control" placeholder="Type something here" required="required">
			</div>
			</div>
		
			<div class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
				<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Search</button>
			</div>
			</div>
	</div>
</div>
</form>

<br />
<?php
	if(isset($_POST['submit'])){
		

		
    	$search_by = addslashes(strip_tags(trim($_POST['search_by'])));
    	$search_value = addslashes(strip_tags(trim($_POST['search_value'])));

    	$search_value = $search_value.'%';

    	$q = "SELECT * FROM question_paper WHERE ".$search_by." LIKE :search_value";
		$stmt = $core->dbh->prepare($q);
		$stmt->bindParam(':search_value',$search_value, PDO::PARAM_STR);
		$stmt->execute();
				
 ?>
<h4>Search Results</h4>
<table class="table table-bordered">
		<thead>
			<tr>
				<td width="5%">Sl.no</td>
				<td width="15%">Paper Code</td>
				<td width="30%">Paper Name</td>
				<td width="15%">Degree</td>
				<td width="10%">Paper Type</td>
				<td width="10%">Years</td>

			</tr>
		</thead>
		<tbody>
			<?php
			
			
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
<?php } ?>
</div>