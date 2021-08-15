<html>

<title>TreeChain</title>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">


<div class="head">
<center>
<h2>TreeChain</h2>
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
 Plant a Tree <br>&nbsp& Register it on<br>&nbspBlockchain.
</font>
<P>

&nbsp
<button class="register" onclick="location.href='post.php';">
Register Here
</button>
&nbsp
<button class="view" onclick="location.href='chain.json';">
View Blockchain
</button>






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
  



  

 
 </html>
