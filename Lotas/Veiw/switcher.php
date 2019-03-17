<?php 
	include 'NavBar.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.ln_switcher {
		    list-style: none;
		    display: inline-flex;
		    background-color: #e41d0c0d;
		}
		.en_ln, .ar_ln {
			padding: 5px;
		    width: 27px;
		    text-align: center;
		    color: white;
		}
		.en_ln {
			background-color: green;
		    border-bottom-left-radius: 5px;
		    border-top-left-radius: 5px;
		}
		.ar_ln {
		    background-color: darkgray;
		    border-bottom-right-radius: 5px;
		    border-top-right-radius: 5px;
		}
		.en_ln:hover {
			background-color: darkgreen;
		}
		.ar_ln:hover {
			background-color: gray
		}
		.ln_ {
			background-color: #58ab79;
		    padding: 3px 15px;
		    border-radius: 5px;
		    color: white;
		}
		.ln_:hover {
			color: white;
		}
	</style>
</head>
<body>
	<ul class="ln_switcher">
		<li class="en_ln"><a href="">En</a></li>
		<li class="ar_ln"><a href="">Ar</a></li>
	</ul>
	<ul class="pagination">
        <li><a href="#" style="background-color: yellow">En</a></li>
        <li class=""><a href="#">Ar</a></li>
    </ul>
    <a href="" class="ln_">En</a>
</body>
</html>