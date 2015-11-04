<?php

$hubspotApiKey = getenv('HUBSPOT_API_KEY');

?>



<!DOCTYPE html>
<html>

<head>
	
<title>Unsubscribe</title>
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>

<body style="background:#eee;">

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default" style="margin-top:40px;">
			<div class="panel-body">
				<h2>Unsubscribe</h2>
				<br>
				<?php
				if($_SERVER['REQUEST_METHOD'] != 'POST'){
				?>
					<form method="post" action="">
						<div class="form-group">
							<p>Enter your email address to unsubscribe.</p>
							<label>Email address</label>
							<input type="text" class="form-control" name="email" placeholder="Email">
						</div><!-- form-group -->
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Unsubscribe</button>
						</div><!-- form-group -->
					</form>
				<?php
				}
				else{
					$email = $_POST['email'];
					
					$data = array('unsubscribeFromAll' => true);
					$data_json = json_encode($data);
					
					$url = "https://api.hubapi.com/email/public/v1/subscriptions/$email?hapikey=$hubspotApiKey";
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_exec($ch);
					curl_close($ch);
					
					echo "<div class='alert alert-success' role='alert'><strong>$email</strong> has been unsubscribed.</div>";
				}
				?>
			</div>
		</div>
	</div><!-- column -->	
</div><!-- row -->
	
</body>

</html>
