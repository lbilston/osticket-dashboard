<!doctype html>
<?php
include( 'config.php' );
$deptID = 1;


/* SQL Code to get total number of Open Jobs */

$allTicketInfo = mysqli_query( $link, "SELECT * FROM `ost_ticket` WHERE `status_id` <= 1 AND `dept_id` = $deptID ORDER BY `lastupdate` ASC" );
$allTicketRow = mysqli_fetch_array( $allTicketInfo );
$allTickets = mysqli_num_rows( $allTicketInfo );

/* SQL Code to get total number of Unanswered Open Jobs */
$openTicketInfo = mysqli_query( $link, "SELECT * FROM `ost_ticket` WHERE `status_id` <= 1 AND `dept_id` = $deptID AND `isanswered` = 0" );
$openTicketRow = mysqli_fetch_array( $openTicketInfo );
$openTickets = mysqli_num_rows( $openTicketInfo );

/* SQL Code to get total number of Answered Open Jobs */
$waitTicketInfo = mysqli_query( $link, "SELECT * FROM `ost_ticket` WHERE `status_id` <= 1 AND `dept_id` = $deptID AND `isanswered` = 1" );
$waitTicketRow = mysqli_fetch_array( $waitTicketInfo );
$waitTickets = mysqli_num_rows( $waitTicketInfo );


?>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>OSTicket Dashboard</title>

	<!-- Custom styles for this template -->
	<style>
		body
		{
			background-color: darkslategray;
			color: #ddd;
		}
		h2
		{
			color: #eee;
			text-align: center;
		}
		table
		{
			color: #222222;
		}
		.tabletext
		{
			font-size: 20;
			color: #000;			
		}
		

	</style>
</head>

<body>

	<main role="main">
		<div class="container">
			<div class="row">
				<div class="col-md-12"><p>&nbsp;</p></div>
			</div>
		</div>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<button type="button" class="btn btn-lg btn-primary btn-block"><h1>Awaiting Technician <br> <?php echo $openTickets ?></h1> </button>
				</div>
				<div class="col-md-6">
					<button type="button" class="btn btn-lg btn-success btn-block"><h1>Awaiting User <br> <?php echo $waitTickets ?></h1> </button>

				</div>
			</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 header">
				<p>&nbsp;</p></div>
				<p>&nbsp;</p></div>
			</div>


			<div class="row">
				<div class="col-md-12">

					<table width="100%" border="1" class="table">
						<tbody>
							<tr class="dark thead-dark">
								<th scope="col">Subject</th>
								<th scope="col">From</th>								
								<th scope="col">Action</th>
								<th scope="col">Last Update</th>
							</tr>

							<?php
							/* Loop through all the tickets */
							while ( $row = mysqli_fetch_assoc( $allTicketInfo ) ) {
								$ticketID = $row[ "ticket_id" ];
								$ticketNumber = $row[ "number" ];
								$lastUpdate = $row[ "lastupdate" ];
								$isAnswered = $row[ "isanswered" ];
								$topicID = $row["topic_id"];
								$userID = $row["user_id"];
								
								$formatDate = date("d M y G:i", strtotime($lastUpdate));

								if ( $isAnswered == 0 ) {
									$answered = "Awaiting Technician";
								}
								if ( $isAnswered == 1 ) {
									$answered = "Awaiting User";
								}
								
								/* Get Staff Name */
								$staffInfo = mysqli_query( $link, "SELECT * FROM `ost_user` WHERE `id` = $userID");
									while ( $userRow = mysqli_fetch_assoc( $staffInfo ) ) {
										$name = $userRow["name"];
									}
								
								/* Topic 4 is custom to Warringa Park School for iOS Application Requests */
								if ($topicID != 4 )
								{

								
								$objectInfo = mysqli_query( $link, "SELECT * FROM `ost_form_entry` WHERE `object_id` = $ticketID AND `form_id` = 2" );
									while ( $objectRow = mysqli_fetch_assoc( $objectInfo ) ) {
										$entryID = $objectRow["id"];
									}
								
								$entryInfo = mysqli_query( $link, "SELECT * FROM `ost_form_entry_values` WHERE `entry_id` = $entryID AND `field_id` = 20" );
									while ( $entryRow = mysqli_fetch_assoc( $entryInfo ) ) {
										$subject = $entryRow["value"];
									}
								}
								
								/* Start Comment out for most users - Used for WPS for App Requests */
								
								if ($topicID == 4 )
								{
									
								$objectInfo1 = mysqli_query( $link, "SELECT * FROM `ost_form_entry` WHERE `object_id` = $ticketID AND `form_id` = 6" );
								while ( $row3 = mysqli_fetch_assoc( $objectInfo1 ) ) {
									$entryID = $row3["id"];
								}
								
								$entryInfo1 = mysqli_query( $link, "SELECT * FROM `ost_form_entry_values` WHERE `entry_id` = $entryID AND `field_id` = 34" );
								while ( $row4 = mysqli_fetch_assoc( $entryInfo1 ) ) {
									$subject = $row4["value"];
									$subject = "<b>App Request</b> - " . $row4["value"];
								}

								/* End comment out for most users - Used for WPS for App Requests */
								}

							?>								
							<tr <?php if ($isAnswered==0) { echo 'class="table-primary"'; } else { echo 'class="table-success"'; }  ?> >
								<td class="tabletext">
									<?php echo $subject ?>
								</td>
								<td class="tabletext">
									<?php echo $name ?>
								</td>
								<td class="tabletext">
									<?php echo $answered ?>
								</td>
								<td class="tabletext">
									<?php echo $formatDate ?>
								</td>
							</tr>




							<?php

							}
							?>
						</tbody>
					</table>
				</div>
			</div>



			<hr>

		</div>
		<!-- /container -->

	</main>

	<footer class="container">
		<p align="center">&copy;
			<?php echo $siteName ?> 2017-2018</p>
	</footer>

</html>

