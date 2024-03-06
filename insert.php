<html>
    <head>
        <title>Connecting mysql</title>
    </head>
    <body>
        <?php
           $dbhost = "localhost:3307";
           $dbuser = "root";
           $dbpass = "Kanna0510$";
           $dbname = "Empd";
           $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

           if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
           }
           $sql = "INSERT INTO details (name, department, dof,dol,rol) VALUES ('kanna', 'Accounts','05-10-2021','08-11-2023','Father got transfer')";
           if ($conn->multi_query($sql) === TRUE) 
           {
             echo "New record created successfully";
            } 
            else {
                echo "Error: ". $sql . "<br>" . $conn->error;
            }
            $conn->close();
        ?>
    </body>
</html>