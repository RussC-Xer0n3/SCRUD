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
