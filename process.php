<?php include "database.php"; ?>
<?php session_start( ); ?>
<?php 
// scrore
if (isset($_SESSION['score'])) {
    $_SESSION["score"] = 0;

}
if($_POST){
       $number=$_POST["number"];
       $selected_choice = $_POST["choice"];
}