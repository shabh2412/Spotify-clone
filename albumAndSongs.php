<?php include("includes/includedFiles.php"); //including required files. 

    //DB connection code starts here 
    ob_start();

    // session_start();

    $timezone = date_default_timezone_set("Asia/Kolkata");

    $conn = mysqli_connect("localhost", "root", "24261209", "muscify");

    if (mysqli_connect_errno()) {
        echo "Failed to connect : ".mysqli_connect_errno();
    }
    #end of DB connection code
    $albumQuery = "SELECT albums.title AS Album_Name,Songs.title AS Song_Name from albums,Songs WHERE Songs.album = albums.id ORDER BY `albums`.`id` ASC";

    $albqueryResult = mysqli_query($conn, $albumQuery);

    while($row = mysqli_fetch_array(($albqueryResult))){
        $myArr = array();
        $myArr['album'] = $row['Album_Name'];
        $myArr['song'] = $row['Song_Name'];
        $myList[] = $myArr;
    }

    $initially = 0;     //setting a control variable before iterating, check the iterating function. 
    iterating($myList, $initially);


    function print_first_element($myList, $index){  //function to print the album name and first song in the album
        echo "<hr>";
        $x = $myList[$index]['album'];
        echo "<h1>".$x."</h1>";
        echo "<hr>";
        echo "<br>";
        echo $myList[$index]['song'];
        echo "<br>";
        echo "<br>";
        return $x;
    }

    function iterating($myList, $n){
        foreach($myList as $index => $array){    //iterating through the given array, with "index" as key and "array" as value
            if($n == 0){
                $x = print_first_element($myList, $index);
                $n++;
            } else{
                if($n == $myList[$index]['album']){
                    echo $myList[$index]['song'];
                    echo "<br>";
                    echo "<br>";
                } else{
                    $x = print_first_element($myList, $index);
                }
            }
        }
    }
?>
