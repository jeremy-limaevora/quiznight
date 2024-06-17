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
       $next= $number++;

    //    get total question
    $query="SELECT * FROM Question";
    // get result
    $result=$mysqli->query($query)or die ($mysqli->error.__LINE__);
    $total=$result->num_rows;
    // get is correct
    $query= "SELECT * FROM choice WHERE answer = $number AND is_correct = 1";
    // get result 
    $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
    // get row 
    $row=$result->fetch_assoc();
    // set corecteur choice
    $correct_choice = $row["id"];
    // compare
    if($correct_choice == $selected_choice){
        $_SESSION["score"]++;
    }  
    if($number==$total){
        header("Location: final.php");
        exit();
    } else{
        header("Location: question.php?n=.next");
    }
}