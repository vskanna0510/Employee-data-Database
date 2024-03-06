<html>
    <head>
        <title>Connecting mysql</title>
    </head>
    <body>
        <?php
           $dbhost = "localhost:3307";
           $dbuser = "root";
           $dbpass = "Kanna0510$";
           $conn = new mysqli($dbhost, $dbuser, $dbpass);

           if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
           }
           $sql = "CREATE DATABASE Empd";
           if ($conn->query($sql) === TRUE) 
           {
                echo "Database created successfully";
            } 
            else {
                echo "Error creating database: " . $conn->error;
            }
            $conn->close();
        ?>
    </body>
</html>
