<?php
include 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/register.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/search.css">
</head>
    
<body>
<!-- NAV -->
<?php
    require 'php\partials\mainheader.php';
    
 ?>

<!-- <h1>Search page</h1> -->


<div class="movie_container">
    <?php
        if (isset($_POST['submit_search']))
        $search  = mysqli_real_escape_string($con, $_POST['search']);
        $sql = "SELECT * FROM movies WHERE Title LIKE '%$search%' OR ReleaseYear LIKE '%$search%' OR Genre  LIKE '%$search%' OR Country  LIKE '%$search%'";
        $result = mysqli_query($con, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult == 1) {
            echo "There is ".$queryResult." result!";
        }elseif($queryResult >1){
        echo "There are ".$queryResult." results!";
        }
        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a href='singleMovie.php?title=".$row['Title']."'><div class='article_box'>
                    <h2>".$row['Title']."</h2>               
                    <h3>".$row['ReleaseYear']."</h3>               
                    <h3>".$row['Genre']."</h3>               
                    <h3>".$row['Director']."</h3>               
                    <h3>".$row['Country']."</h3>               
                </div></a>";
            }
        }else{
            echo "There are no results matching your search!";
        }
    ?>
</div>
</body>
</html>