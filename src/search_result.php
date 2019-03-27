<?php
include ('.\config.php');
include ('.\functions.php');

//$books = DB::query("SELECT * FROM books");
$heading = 'Search results';
//$title_results = "";
//$author_results = "";
$row_results = "";

database_connect();
// process registering book into database
$queryTitle = (isset($_GET['queryTitle']) ? $_GET['queryTitle'] : '');
$queryAuthor = (isset($_GET['queryAuthor']) ? $_GET['queryAuthor'] : '');

// gets value sent over search form

$min_length = 3;  // you can set minimum length of the query if you want

if (strlen($queryTitle) >= $min_length || strlen($queryAuthor) >= $min_length) { // if query length is more or equal minimum length then

    $queryTitle = htmlspecialchars($queryTitle);
    $queryAuthor = htmlspecialchars($queryAuthor); // changes characters used in html to their equivalents, for example: < to &gt;
    
    $queryTitle = $db->real_escape_string($queryTitle);
    $queryAuthor = $db->real_escape_string($queryAuthor); // makes sure nobody uses SQL injection

    //echo $query;

    $row_results = DB::query("SELECT * FROM books
            WHERE (`Title` LIKE '%" . $queryTitle . "%') OR (`Author` LIKE '%" . $queryAuthor . "%')") or die(mysql_error());
            
    //$author_results = DB::query("SELECT * FROM books
    //WHERE (`Author` LIKE '%" . $queryAuthor . "%')") or die(mysql_error());



/*$title_results = DB::query("SELECT * FROM books
            WHERE (`Title` LIKE '%" . $queryTitle . "%')") or die(mysql_error());
            
    $author_results = DB::query("SELECT * FROM books
    WHERE (`Author` LIKE '%" . $queryAuthor . "%')") or die(mysql_error());*/


 
pr($raw_results);

    

    // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
    // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
    // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'

        
    /*if (empty($title_results) && empty($author_results)) { // if there is no matching rows do following
        header('location: advance_search.php');
    }*/
    } else { // if query length is less than minimum
        echo "Minimum length is " . $min_length;
    }



    //was here
    //show the template file
echo $twig->render('search_result.html', array('results'=>$row_results, 'heading'=> $heading));


?>