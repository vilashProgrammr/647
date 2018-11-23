<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

$ch = curl_init();
include_once 'dbconfig.php';
$lastid = insert_data($conn);
$sql_query="SELECT COUNT(*) FROM users "  ;
$result_set=mysqli_query($conn,$sql_query);
$fetched_row=mysqli_fetch_array($result_set);
//print_r($fetched_row["COUNT(*)"] );
//EDIT TESTCASE
//echo "http://localhost/Welcome/index.php?delete_id=".$lastid;
curl_setopt($ch, CURLOPT_URL,"http://localhost/Welcome/edit_data.php?edit_id=".$lastid);
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS,
		"btn-update=true&first_name=edited&last_name=edited&city_name=edited");


// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
//echo $server_output;
curl_close ($ch);
//CHECK MYSQL AFTER EDIT
$select = "SELECT * FROM users where user_id = '".$lastid."';";
//echo "select first_name,last_name,user_city from user where user_id = ".$lastid;
$result_set2=mysqli_query($conn,$select);
if(mysqli_num_rows($result_set2)>0)
{
	$row=mysqli_fetch_row($result_set2);
	//print_r($row);
	
	if($row[1]=="edited" && $row[2]=="edited" && $row[3]=="edited" ){
		echo  "PASSED|Testcase 1|Edit functionality test|5\n";
	}
	else
		echo  "FAILED|Testcase 1|Edit functionality test|5\n";
}



$ch = curl_init();
//Delete testcase
//echo "http://localhost/Welcome/index.php?delete_id=".$lastid;
curl_setopt($ch, CURLOPT_URL,"http://localhost/Welcome/index.php?delete_id=".$lastid);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
//echo $server_output;
curl_close ($ch);

$sql_query2="SELECT COUNT(*) FROM users "  ;
$result_set2=mysqli_query($conn,$sql_query2);
$fetched_row2=mysqli_fetch_array($result_set2);
//echo "count after =".$fetched_row2["COUNT(*)"] ;
if($fetched_row["COUNT(*)"]> $fetched_row2["COUNT(*)"]){
	echo  "PASSED|Testcase 2|Delete functionality test|5\n";
}
else 
	echo  "FAILED|Testcase 2|Delete functionality test|5\n";




function insert_data($conn){
	$sql_query = "INSERT INTO users(first_name,last_name,user_city) VALUES('insertedxx','insertedxx','insertedxx')";
	if(mysqli_query($conn,$sql_query)){
	
	return mysqli_insert_id($conn);
	}
	else return -999;
}

?>