<?php
    include("includes/includedFiles.php");
    if(isset($_GET['query'])) {
        $query = urldecode($_GET['query']);
    } else {
        $query = "";
    }
?>

<div class="searchContainer">
    <h4>
        Search for an Artist, Album, or a Song
    </h4>
    <input type="text" class="searchInput" value="<?php echo $query;?>" placeholder="Start Typing">
</div>

<script>
    $(function(){
        var timer;
        $(".searchInput").keyup(function () {
            clearTimeout(timer);
            timer = setTimeout(function() {
                console.log("Hi!");
            }, 2000); //wait 2 sec and execute the code.
        });
    });
</script>