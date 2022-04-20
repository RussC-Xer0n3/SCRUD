<?php

//open dbconnect
    $dbname = 'standard';
    $dbuser = 'user';
    $dbpassw = '1234abcd';
    $dbport = '8080';
    $dbconnect = ($dbname, $dbuser, $dbpass, $dbport);
    if (!$dbconnect) {
        msqli.close($dbconnect);
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
            <p class="errormessage" style="color:red;">Connection error, please reload the page' . \n . 'if the problem persists, contact support. ' . mysqli_connect_error() . '</p>
            <button class="reload"><meta http-equiv="refresh" content="onClick">reload</button><button class="contact" href="mailto:support@domain.com">contact</button>
            </content>
            </body>
            </html>';
    } else {
        mysqli.connect($dbconnect);
    }

    ?>