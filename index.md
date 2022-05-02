<style>
/* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}
/* Dropdown button */
.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}
/* Add a red background color to navbar links on hover */
.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: aliceblue;
    color: teal;
  }
  /* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: teal;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: aliceblue;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}
/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}
/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<nav class="w3-container w3-teal w3-center w3-margin-top">
    <div class="dropdown">
        <button class="dropbtn">Projects
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="https://russc-xer0n3.github.io/NetPCaC">NetPCaC</a>
          <a href="https://russc-xer0n3.github.io/LANDROVER">LANDROVER</a>
          <a href="https://russc-xer0n3.github.io/MAC">MAC Address</a>
          <a href="https://russc-xer0n3.github.io/SCRUD">SCRUD</a>
          <a href="https://russc-xer0n3.github.io/Remove">Code Syntax Removal</a>
          <a href="https://russc-xer0n3.github.io/PassGen">PassGen</a>
          <a href="https://russc-xer0n3.github.io/C_Shapes">C Programming Shap`es</a>
          <a href="https://russc-xer0n3.github.io/Shapes---python">Python Shapes and space</a>
          <a href="https://russc-xer0n3.github.io/The-old-Fusion-Repository">Fusion?</a>
          <a href="https://russc-xer0n3.github.io/The-Russian-Wedding-Rings">The Russian Wedding Rings</a>
          <a href="https://russc-xer0n3.github.io/QBit-and-GParticulates">QBit and GParticulates</a>
          <a href="https://russc-xer0n3.github.io/Thyme-old">Thyme</a>
          <a href="https://russc-xer0n3.github.io/IP-Port">IP and Ports</a>
          <a href="https://russc-xer0n3.github.io/Xer0n3">Xer0n3</a>
          <a href="https://russc-xer0n3.github.io/ScrambledEggs">ScrambledEggs</a>
          <a href="https://russc-xer0n3.github.io/Py">Python Code</a>
        </div>
    </div>
    <br>
      <a href="https://www.facebook.com/profile.php?id=100075972987666"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
      <a href="https://www.instagram.com/russellclarke821"><i class="fa fa-instagram w3-hover-opacity"></i></a>
      <a href="https://www.pinterest.co.uk/russellclarke821/"><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>
      <a href="https://twitter.com/Developing821"><i class="fa fa-twitter w3-hover-opacity"></i></a>
      <a href="https://www.linkedin.com/in/russell-clarke-09a1a5238"></a><i class="fa fa-linkedin w3-hover-opacity"></i>
      <a href="https://russc-xer0n3.github.io">My CV and additionsl information</a>
    <br>
</nav>
# SCRUD Buttons
## Search, Create, Read, Update and Delete buttons with functionality for any CMS website

The content here is for any CMS, it will be finished in due course however, at present it is temporarily on hold and might not work on all sites.

### What's included so far
So far, the search functionality is fairly generic, The button is created and the onlick functionality is written in to run a search on the database of your choice in the content management system (CMS).

The style sheet is Internal as opposed to external or inline, I like to make a lot of my style sheets internal, that way, they are accessible from inside the html / php file I ma working on and they're not inline which poses front-end security and rendering issues.

The search form is divided into the Navigation header ```<nav>``` and has it's own internal styling.

```
<div class="search">
                <form id="searchform" class="form" action="/search.php" method="POST">
                    <input type="text" placeholder="search..." name="search">
                    <button id="search" class="scrud" type="submit">search</button>
                </form>
            </div>
```
and the search.php script has quite a lot of code in there since it is handling a few other pieces of server side functionality too

### sanitisation
Sanitising the search string and failing gracefully is part of the coding conducts and helps the user to understand where they may have gone wrong and even giving feed back to the user about their search term is quite important.
```
<?php

    //sanitisation and verification function to check string submitted via HTML form
    function sanitise ($searchterm) {
        
        $exp = "/['{}[]#~!()/*;:+-,%=|¬`]/.u\s";

        if ($searchterm.preg_match($exp, $searchterm)) {
            $searchterm = trim($searchterm);
            $searchterm = stripslashes($searchterm);
            $searchterm = htmlspecialchars($searchterm);
            error_log;
            error_reporting;
            echo ' 
            <!DOCTYPE HTML>
            <head>
            <style>
            content .error {
                display : block;
                position : relative;
                width : 200px;
                height : 75px;
                margin : 100%, 100%, 100%, 100%;
                padding : 5px, 5px, 5px, 5px;
            }
    
            p .errormessage {
                display : block;
                position : relative;
                padding : 5px, 5px, 5px, 5px;
            }
    
            button .reload .contact {
                background-color: blue;
                color: #fff;
            }
    
            button :hover {
                color : black;
                background-color : aliceblue;
            }
    
            </style>
            </head>
            <body>
            <content class="error">
                <p class="error" style="color:red;">Unfortunately you are not allowed non alphanumeric characters, ' . \n . ' please reload the page if the problem persists, contact support.</p>
                <button class="reload"><meta http-equiv="refresh" content="onClick">reload</button><button class="contact" href="mailto:support@domain.com">contact</button>
            </content>
            </body>
            </html>';
            
            mysqli.close($dbconnect);
        } else {
            $searchterm = trim($searchterm);
            $searchterm = stripslashes($searchterm);
            $searchterm = htmlspecialchars($searchterm);
            continue;
        }
        
        return $searchterm;
    }
```

### Returning the data
Here, we are retruning the data to the index.php script in a html formatted string to be pren=sented in a table presentation style
```
    //sanitise and validate the string search term from the HTML form
    if (!empty($_POST['search'])) {
        $searchterm = santitise($_POST['search']);
    } else {
        $searchterm = NULL;
        $row = '<p class="error" style="color:red;">You must enter a search term or revise your search....</p>';
    }
```

### The table in index.php
```
<section class="table">
        <!--- Put form feed here and return $i as the result in pagination --->
        <table id="1" class="table_data">    
            <tr><th><td>ID</td><td>name</td><td>data</td><td>number</td><td>a dress</td><td>nice shiny shoes</td></th></tr>
            '. $row .'
        </table>
    </section>
```

### Connecting to the Database
```
    //connect for sql statement
    mysqli.connect($dbconnect);
```

### Making logical selections of data in a fictition database
```
    //select statements, logic is for search term to be autocorrected to return results if no results found using wildcards
    //in the select statement after running first check in the DB to run a thorough search, else search term rendered NULL
    //reports no records found with friendly message.
    if (!$searchterm == NULL) {
        $result = mysqli.query('SELECT * FROM '.$dbname.' WHERE '.$searchterm.';');
    } elseif ($result == NULL) {
        $result = mysqli.query('SELECT * FROM '.$dbname.' WHERE '.$searchterm.'%;');
    } elseif ($result == NULL) {
        $result = mysqli.query('SELECT * FROM '.$dbname.' WHERE %'.$searchterm.'%;');
    } else {
        $searchterm == NULL;
        $result = '<p class="error" style="color:red;>We\'re sorry, there were no matching records in the database.<br>Try running your search again with more or less specific details.</p>';
    }
    
    //loop through db table during request and return the data tuples
    for ($row = 0; $row <= $result.length(); $row++) {
        //return statements for display on frontend format them
        $i = 0;
        
        //could put an incrementor here to get row id's however your db should have UID's
        $row = '<tr id="'. $i++; .'" class="table_data_row"><th>'. $i++; .'</th>'. $result; .'</tr>';
        
        return $row;
    }
```

### Making certain to close off the connection when data is returned
```
    //close session each time
    mysqli.close($dbconnect);
?>
```

### Moving forward
Hopefully I will get the functionality to all the buttons completed in due course, they will be generic to a fictitious database since then the scripts only need to be modififed according to back-end and any obsolescence in the language.
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta charset="UTF-8">
    <meta name="description" content="Projects and Portfolio">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, MySQLi, Python, Java, C, C++, C#, Time, Shapes">
    <meta name="author" content="Russell Clarke">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <a href="https://www.facebook.com/profile.php?id=100075972987666"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
  <a href="https://www.instagram.com/russellclarke821"><i class="fa fa-instagram w3-hover-opacity"></i></a>
  <a href="https://www.pinterest.co.uk/russellclarke821/"><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>
  <a href="https://twitter.com/Developing821"><i class="fa fa-twitter w3-hover-opacity"></i></a>
  <a href="https://www.linkedin.com/in/russell-clarke-09a1a5238"></a><i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
