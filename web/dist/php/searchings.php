<?php  
$con = mysqli_connect('127.0.0.1','jef','','kabyleWords');
if (!$con) {die('Conection To DATABASE FAIL ! ! !');}

// if (isset($_GET['wordsLikeThis'])) 
// {
// 	$backWord = htmlspecialchars($_GET['backWord']);
// 	$word = htmlspecialchars($_GET['wordsLikeThis']);
// 	$req = mysqli_query($con,"SELECT * FROM words WHERE tamazight LIKE '$word%' OR backWord LIKE '%$backWord%' LIMIT 5");

// 	//var_dump(mysqli_fetch_assoc($req)['tamazight']);
// 	while($row = mysqli_fetch_array($req))
// 	{
// 		echo "<p>".htmlspecialchars($row['backWor'])." ".htmlspecialchars($row['tamazight'])."<p>";
// 	}

// }

if(isset($_REQUEST["wordsLikeThis"])){
    // Prepare a select statement
    $sql = "SELECT * FROM words WHERE tamazight LIKE ? ORDER BY RAND() LIMIT 10";
    
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = '' . $_REQUEST["wordsLikeThis"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p class='mots'>" . $_REQUEST["backWord"] . " ". $row["tamazight"]. "</p>";
                }
            } else{
                echo "<p>Ulac Acu Idufiy !</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 



if (isset($_GET['GenerateText'])) {
    $req = mysqli_query($con,'SELECT * FROM words ORDER BY RAND() LIMIT 1');
    $randomWord = mysqli_fetch_assoc($req)['tamazight'];
    $phase = "";
    for ($i=0;$i < 6; $i++)
    { 
        $req = mysqli_query($con,"SELECT * FROM words WHERE backWord LIKE '$randomWord%' OR frontWord LIKE '$randomWord%' ORDER BY RAND() LIMIT 1");
        $randomWord = mysqli_fetch_assoc($req)['tamazight'];
        $phase .= $randomWord . " ";
    }
    echo $phase . ".";

}
// close connection
mysqli_close($con);
?>