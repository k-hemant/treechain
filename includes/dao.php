<?php

class DAO {

  function read_all() {
    try {
      $jsondata = file_get_contents(dirname(dirname(__FILE__))."/chain.json");
      $arr_data = json_decode($jsondata, true);
      return $arr_data;
    }
    catch(Exception $e) {
      echo "Error: " . $e->getMessage();
      exit();
    }
  }

  function get_previous_hashid($chain){
    $lastEl = array_values(array_slice($chain, -1))[0];
    return $lastEl["hashid"];
  }

  function get_previous_index($chain){
    $lastEl = array_values(array_slice($chain, -1))[0];
    return $lastEl["index"];
  }

 function get_new_hashid($previous_hashid,$index,$timestamp,$content){
   $full_string = $previous_hashid.$index.$timestamp.$content;
   $hash  = hash('sha256',$full_string);
   return $hash;
 }

 function read_content($content) {
   $arr_content = json_decode($content);
   return $arr_content;
 }


}


?>
