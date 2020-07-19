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
    <input type="text" class="searchInput" value="<?php echo $query;?>" placeholder="Start Typing" onfocus="this.value = this.value">
</div>

<script>
    $(".searchInput").focus();
    $(function(){
        var timer;
        $(".searchInput").keyup(function () {
            clearTimeout(timer);
            timer = setTimeout(function() {
                var val = $(".searchInput").val();
                openPage("search.php?query=" + val);
            }, 2000); //wait 2 sec and execute the code.
        });
    });
</script>