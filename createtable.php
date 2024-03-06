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
           $sql = "CREATE TABLE details (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            department VARCHAR(255) NOT NULL,
            dof VARCHAR(20) NOT NULL,
            dol VARCHAR(20) NOT NULL,
            rol VARCHAR(20) NOT NULL
            )";

           if ($conn->query($sql) === TRUE) 
           {
                echo "Table created successfully";
            } 
            else {
                echo "Error creating Table: ";
            }
            $conn->close();
        ?>
    </body>
</html>