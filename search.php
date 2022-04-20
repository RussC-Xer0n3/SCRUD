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

    //sanitise and validate the string search term from the HTML form
    if (!empty($_POST['search'])) {
        $searchterm = santitise($_POST['search']);
    } else {
        $searchterm = NULL;
        $row = '<p class="error" style="color:red;">You must enter a search term or revise your search....</p>';
    }

    //connect for sql statement
    mysqli.connect($dbconnect);

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

    //close session each time
    mysqli.close($dbconnect);
?>