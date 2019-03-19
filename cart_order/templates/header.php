<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>T-Model</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	

	<script>
		function formToggle(id) {
			let formAppear = document.getElementById(id);
			formAppear.style.display !== 'block' ? formAppear.style.display = 'block' : formAppear.style.display = 'none' 
		}
		function promHide(id) {
			document.getElementById(id).style.display = "none";
			console.log("clicked")
			// let prom = document.getElementById(id);
			// //return alert("Done!")
			// return prom.style.display = 'none'; //? prom.style.display = 'none' : prom.style.display = 'block'; 
		}
		function confirm_delete() {
  			return confirm('Are you sure?');
		}
		// function redirect() {
 		// 	//document.getElementById("myButton").onclick = function () {
        // 	location.href = "confirm_order.php";
		// //}
		// };
	</script>
</head>

<body>
	<h1 class="company_name">T-Model</h1><br>
