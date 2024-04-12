<?php
require_once "config.php";

$fname = $email = $feed = "";
$fname_err = $email_err = $feed_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  
// Check for abc
if(empty(trim($_POST['fname']))){
    $fname_err = "it cannot be blank";
}
elseif(strlen(trim($_POST['fname'])) < 2){
    $fname_err = "it cannot be less than 2 characters";
}
else{
    $fname = trim($_POST['fname']);
}


// Check for def
if(empty(trim($_POST['email']))){
    $email_err = "it cannot be blank";
}
elseif(strlen(trim($_POST['email'])) < 2){
    $email_err = "it cannot be less than 2 characters";
}
else{
    $email = trim($_POST['email']);
}


// Check for def
if(empty(trim($_POST['feed']))){
    $feed_err = "it cannot be blank";
}
elseif(strlen(trim($_POST['feed'])) < 2){
    $feed_err = "it cannot be less than 2 characters";
}
else{
    $feed = trim($_POST['feed']);
}
// If there were no errors, go ahead and insert into the database
if(empty($fname_err) && empty($email_err) && empty($feed_err))
{
    $sql = "INSERT INTO feedback (fname, email, feed) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sss", $param_fname, $param_email, $param_feed);

        // Set these parameters
        
        $param_fname = $fname;
        $param_email = $email;
        $param_feed = $feed;
     
        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: after_form.html");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>
