<?php
    //error reporting on test server, REMOVE FOR PRODUCTION SERVER!!
    ini_set("display_errors", 1); 		
    error_reporting(E_ALL);

    //define our initial variable for session ID
    $code = "";

    //generate keys ourselves using the array_rand method and return the generated ID
    function passgen() {
        $char = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "y", "x", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");  
        $pass = array_rand($char, $num = 64);
        return $pass;
    }

    //for added security scramble the ID to add a little more randomness (hopefully the preg_match will be happy later).
    function scramble($pass){
            $algo = "crc32c";
            $code = password_hash($pass, $algo);
            return $code;
    }

    //call the two methods in procedural order descending
    passgen();
    scramble();

    //set the session key / ID into session ID
    $key = $_SESSION[$code];
    $x = session_id($key);        
    $y = session_id();

    //verify - validation method, validate and error if not valid or if NULL for each session
    function session_valid_id($y, $z) {
        do {
            if ((!session_valid_id($y)) || NULL) {
                //<meta http-equiv="refresh" content="5"> from https://www.geeksforgeeks.org/how-to-make-a-html-link-that-forces-refresh/#:~:text=HTML%20%3Cmeta%3E%20http-equiv%20attribute%20with%20refresh%20value%20specified,seconds%20after%20which%20the%20page%20will%20refresh%20itself.
                
                //close off the session and report errors
                error_get_last;
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
                    <p class="errormessage" style="color:red;">Please reload the page<br>if the problem persists, contact support.</p>
                    <button class="reload"><meta http-equiv="refresh" content="onClick">reload</button><button class="contact" href="mailto:support@domain.com">contact</button>
                </content>
                </body>
                </html>';
                //generate new cookie and code per algorithm and assign in new session
            } else {
                return preg_match('/[-,a-zA-Z0-9]{1-128}$/', $x) > 0;
                break;
            }
        } while ($z);
    }
    //start the session and check if the ID is valid using the method call below to function above
    $z = session_start();
    $z;
    session_valid_id($y, $z);
    echo '
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SCRUD</title>
    <style>

        button .scrud {
            display : block;
            float : left;
            position : top;
            border-radius : 12px;
            padding : 12px;
            margin : 5px;
            font-family : Arial, Helvetica, sans-serif;
            font-size : small;
            color : grey;
        }

        button :hover {
            color : black;
            background-color : aliceblue;
        }

        #search {
            background-color : blue;
        }

        #create {
            background-color : green;
        }

        #read {
            background-color : blue;
        }

        #update {
            background-color : blue;
        }

        #delete{
            background-color : red;
        }

        form .form {
            width : 250px;
            display : block;
            float : left;
            position : top;
            border-radius : 12px;
            padding : 12px;
            margin : 5px;
            font-family : Arial, Helvetica, sans-serif;
            font-size : small; 
        }

        nav {
            display : block;
            position : absolute;
            top : 0px;
            left : 0px;
            width : 100%;
            height : 35px;
            background-color : #fff;
        }

        nav .nav_links {
            display : block;
            float : left;
            margin : 1px;
            padding : 10px;
            height : 15px;
            width : 45px;
            font-family: Arial, Helvetica, sans-serif; 
            background-color: blue;
            color : aliceblue;
        }

        nav .nav_links :hover {
            font-family: Arial, Helvetica, sans-serif;
            background-color : #000;
            color : aliceblue;
        }

        div .search {
            display : block;
            position : absolute;
            right : 0px;
            top : 0px;
            width : 25%;
            height : 15px;
            padding : 10px;
        }

    </style>
  </head>
  <body>
    <header>
        <img></img><h1>SCRUD</h1>
        <nav class="nav">
            <a class="nav_links" href="index.php">HOME</a>
            <a class="nav_links" href="about.php">ABOUT</a>
            <a class="nav_links" href="products.php">PRODUCTS</a>
            <a class="nav_links" href="contact.php">CONTACT</a>
            <div class="search">
                <form id="searchform" class="form" action="/search.php" method="POST">
                    <input type="text" placeholder="search..." name="search">
                    <button id="search" class="scrud" type="submit">search</button>
                </form>
            </div>
        </nav>
    </header>
    '. 
    //Go through page content per page and call the content page dependant
    //https://stackoverflow.com/questions/5755821/if-index-php-show-this-if-not-show-this#:~:text=To%20do%20it%20the%20way%20you%20want%2C%20use,the%20side%20bar%20page%20can%20check%20that%20variable.
    if ($_SERVER['PHP_SELF'] == 'index.php') {
        echo '
    <section class="scrud">
        <button id="create" class="scrud">create</button>
        <button id="read" class="scrud">read</button>
        <button id="update" class="scrud">update</button>
        <button id="delete" class="scrud">delete</button>
    </section>

    <section class="table">
        <!--- Put form feed here and return $i as the result in pagination --->
        <table id="1" class="table_data">    
            <tr><th><td>ID</td><td>name</td><td>data</td><td>number</td><td>a dress</td><td>nice shiny shoes</td></th></tr>
            '. $row; .'
        </table>
    </section>
        ' .; 
    } elseif ($_SERVER['PHP_SELF'] == 'about.php') {
        echo 'html to complete';
        continue;
    } elseif ($_SERVER['PHP_SELF'] == 'products.php') {
        echo 'html to complete';
        continue;
    } elseif ($_SERVER['PHP_SELF'] == 'contact.php') {
        echo 'html to complete';
        continue;
    } else {
        continue;
    }
echo '
    <footer>
      <ul><li><a href="#">Ipsum</a></li><li><a href="#">Ipsum</a></li><li><a href="#">Ipsum</a></li><li><a href="#">Ipsum</a></li><li><a href="#">Ipsum</a></li></ul>
    </footer>
  </body>
</html> ';
?>