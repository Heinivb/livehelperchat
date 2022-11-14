<?php
$myfile = fopen("authCode.txt", "r") or die("Unable to open file!");
// echo fread($myfile,filesize("authCode.txt"));

$dbServerName = "127.0.0.1";
$dbUsername = "myaie_livehelper";
$dbPassword = "6Gz#2q7ASh^u";
$dbName = "myaie_livehelper";

// create connection
$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

$sql =  "SELECT * FROM lh_generic_bot_rest_api where name = 'DialogFlow ES'";
$sql = mysqli_query($conn, $sql) or die(mysqli_error());
while($row = mysqli_fetch_assoc($sql)){
    $config = $row["configuration"];
    $id = $row["id"];
    $data = json_decode($config,true);
    $data["parameters"][0]["auth_bearer"] = fread($myfile,filesize("authCode.txt")-1); 
    $body_rawString = (string)$data["parameters"][0]["body_raw"];
    $body_rawString = str_replace("\"", "\\"."\"", $body_rawString);
    $body_rawString = str_replace("\n", "", $body_rawString);
    $data["parameters"][0]["body_raw"] = $body_rawString;
    if ($data)
    {   
        $parsedData = json_encode($data,true);
        $sqlUpdate = "UPDATE lh_generic_bot_rest_api SET `configuration` = '$parsedData' WHERE id = $id";
        $sqlUpdate = mysqli_query($conn, $sqlUpdate) or die(mysqli_error());
    }
}
fclose($myfile);
$conn->close();
?>