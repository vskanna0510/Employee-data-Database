<?php
require_once "config.php";
 
$name = $department = $dof = $dol = $rol = "";
$name_err = $department_err = $dof_err = $dol_err = $rol_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    $input_department = trim($_POST["department"]);
    if(empty($input_department)){
        $department_err = "Please enter the Employee's Department.";     
    } else{
        $department = $input_department;
    }
    
    $input_dof = trim($_POST["dof"]);
    if(empty($input_dof)){
        $dof_err = "Please enter the Date of Joining .";     
    } else{
        $dof = $input_dof;
    }

    $input_dol = trim($_POST["dol"]);
    if(empty($input_dol)){
        $dol_err = "Please enter the Date of Leaving .";     
    } else{
        $dol = $input_dol;
    }

    $input_rol = trim($_POST["rol"]);
    if(empty($input_rol)){
        $rol_err = "Please enter the Reason for Leaving .";     
    } else{
        $rol = $input_rol;
    }


    if(empty($name_err) && empty($department_err) && empty($dof_err) && empty($dol_err) && empty($rol_err)){

        $sql = "UPDATE details SET name=?, department=?, dof=?, dol=?, rol=? WHERE id=?";
 
        if($stmt = $con->prepare($sql)){
            $stmt->bind_param("sssssi",$param_name, $param_department, $param_dof, $param_dol, $param_rol, $param_id);
            
            $param_name = $name;
            $param_department = $department;
            $param_dof = $dof;
            $param_dol = $dol;
            $param_rol = $rol;
            $param_id = $id;
            
            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();
    }
    
    $con->close();
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM details WHERE id = ?";
        if($stmt = $con->prepare($sql)){
            $stmt->bind_param("i", $param_id);
            
            $param_id = $id;
            
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $name = $row["name"];
                    $department = $row["department"];
                    $dof = $row["dof"];
                    $dol = $row["dol"];
                    $rol = $row["rol"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        $stmt->close();
        
        $con->close();
    }  else{

        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <textarea name="department" class="form-control <?php echo (!empty($department_err)) ? 'is-invalid' : ''; ?>"><?php echo $department; ?></textarea>
                            <span class="invalid-feedback"><?php echo $department_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Date Of Joining</label>
                            <input type="text" name="dof" class="form-control <?php echo (!empty($dof_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dof; ?>">
                            <span class="invalid-feedback"><?php echo $dof_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Date Of Leaving</label>
                            <input type="text" name="dol" class="form-control <?php echo (!empty($dol_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dol; ?>">
                            <span class="invalid-feedback"><?php echo $dol_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Reason for Leaving</label>
                            <input type="text" name="rol" class="form-control <?php echo (!empty($rol_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rol; ?>">
                            <span class="invalid-feedback"><?php echo $rol_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>