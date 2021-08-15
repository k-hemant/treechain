<html>

<title>TreeChain</title>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">


<div class="head">
<center>
<h2><a style="text-decoration:none;color:black;" href="index.php">TreeChain</a></h2>
</center>
</div>

<br><br><br><br><br>



<body class="content">


<center>

<div class="description">
<P>


<div style="float:left;">
<br><br>
&nbsp
<font class="head1">
 Register your<br>&nbspTree on<br>&nbspBlockchain.
</font>
<P>

<!---form-->
<form  enctype="multipart/form-data" method="POST">
<P>
&nbsp

<input type="text" name="name" class="name" placeholder="Enter Your Name" required>
<P>
&nbsp
Choose Your Plant Image File
<br>
&nbsp
<input type="file" name="file" class="name" accept="image/*" required>
<P>
&nbsp
<button class="register">
Register
</button>

</form>

<!--form end-->


</div>

<div style="float:right;">
<img src="plant.png" class="desc1">
</div>
<div style="clear:both;"></div>

</div>
</center>



</body>

<?php

  
  include_once("./includes/dao.php");

  $dao = new DAO();

  $full_chain = $dao->read_all();

  $previous_hashid = $dao->get_previous_hashid($full_chain["chain"]);

  $previous_index = $dao->get_previous_index($full_chain["chain"]);
  $next_index = $previous_index+1;


  
 
  
  ?>
  

<br><br>
<center>
<body class="content">
<div class="description">
<br>
<br>

<?php

if(isset($_POST["name"])){
	

	
		
	$date=date_default_timezone_set("Asia/Calcutta");
$date=date('l jS \of F Y h:i:s A');
	
      echo "&nbspYour Plant hash id:<br />";
	  
$timestamp = round(microtime(true) * 1000);

 $uname = $_POST["name"];
 
  $content = '{"from": "network","to":"'.$uname.'","amount": 1}'; 


  
$arr = json_decode($content, true);

$from=$arr["from"];
$to=$arr["to"];
$amount=$arr["amount"];



$json1 = file_get_contents('chain.json');
$arr1 = json_decode($json1, true);
$last = end($arr1)["index"];
$lastadd = $last+1;
  

$new_hashid = $dao->get_new_hashid($previous_hashid,$next_index,$timestamp,$content);

$data = file_get_contents('chain.json');

$json_arr = json_decode($data, true);


$json_arr[] = array('index'=>$lastadd,'hashid'=>$new_hashid, 'timestamp'=>$timestamp,'proof-of-work'=>'xyz', 'from'=>$from, 'to'=>$to, 'amount'=>$amount);


file_put_contents('chain.json', json_encode($json_arr));

$ext=".png";
$newfilename = $new_hashid.$ext;
move_uploaded_file($_FILES["file"]["tmp_name"], "trees/" . $newfilename);


  echo "&nbsp<a style='text-decoration:none;color:yellow;' href='trees/$new_hashid.png'>$new_hashid</a>";

  
echo "<br><br><img src='https://cdn.statically.io/og/theme=dark/$uname thanks for Planting tree and Registering.You can view your block at index : $lastadd on TreeChain.jpg' width='100%'>";
	
echo "<center><br><br><a class='view' href='chain.json'>
View Your Plant on Blockchain
</a></center><p>";	
	
	// chain end //
	
	
	

}

else{}

?>


</div>
</body>
</center>





</html>
