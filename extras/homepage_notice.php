<?php 
	
	$core = Core::getInstance();

	//count
	$q = "SELECT COUNT(*) as c FROM question_paper";
	$stmt = $core->dbh->prepare($q);
	$stmt->execute();
	$result = $stmt->fetchObject();
	$count = $result->c;
	
	// lastest paper

	$q1 = "SELECT * FROM question_paper ORDER BY paper_id DESC LIMIT 1";
	$stmt1 = $core->dbh->prepare($q1);
	$stmt1->execute();
	
	
?>
<div class="container p-3">
	<div class="row">
		<div class="col-md-8 col-xs-12 col-sm-12 col-lg-8">
			<h4>Statistics</h4>

			<div class="row">
				<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
					<div
						class="card border-primary"
					>
					<div class="card-body">
						<h3><?php echo $count; ?></h3>
						<h5>Total Papers</h5>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
			<div>
				<h4>Notifications</h4>
				<?php
					while($result1 = $stmt1->fetchObject()){

					
				?>
				<div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">New Paper Posted!</h4>
				  <p>Check out our new paper of <b><?php echo $result1->paper_name; ?> (<?php echo $result1->paper_code; ?>)</b></p>
				  <hr>
				  <p class="mb-0">Year: <?php echo $result1->year; ?></p>
				</div>

				<?php } ?>

				<!-- <div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Well done!</h4>
				  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
				  <hr>
				  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
				</div> -->
			</div>

		</div>
	</div>
</div>