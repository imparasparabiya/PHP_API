<?php

include "config/config.php";
$config = new Config();

if (isset($_REQUEST['btn-submit'])) {
    $Name = $_POST['Name'];
    $Age = $_POST['Age'];
    $Job_Title = $_POST['Job_Title'];
    $Department = $_POST['Department'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];

    $res = $config->insertEmployes($Name, $Age, $Job_Title, $Department, $Email, $Contact);

    if ($res) {
        // header("Location: dashboard.php");
        //     echo '<div class="container pt-5"><div class="alert alert-success alert-dismissible fade show" role="alert">
        //    <strong>Success!</strong> Record Inserted Successfully....
        //    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //    </div></div>';
        echo '
                    <div class="container pt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                                    <strong>Success!</strong> Record has been inserted successfully.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>';

    } else {
        // echo '<div class="container pt-5"><div class="alert alert-danger alert-dismissible fade show" role="alert">
        // <strong>Failure!</strong> Record Insertion Failed....
        // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        // </div></div>';
        echo '
            <div class="container pt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                            <strong>Failure!</strong> Record insertion failed. Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>';

    }
}
// for All data Fetch
$fetch_emp = $config->fetchEmployes();

// for Delete Data
if (isset($_REQUEST['btn_delete'])) {
    $id = $_REQUEST['delete_id'];

    $res = $config->deleteEmployes($id);

    if ($res) {
        echo '
                    <div class="container pt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                                    <strong>Success!</strong> Record has been deleted successfully.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>';

    } else {
        echo '
            <div class="container pt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                            <strong>Failure!</strong> Record deletion failed. Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>';

    }

}

// for Update Data

$edit_emp_data = null;

if (isset($_POST['btn_edit'])) {
    $edit_id = $_REQUEST['id'];
    $res = $config->fetchingSingleEmployes($edit_id);
    $edit_emp_data = mysqli_fetch_assoc($res);

}
if (isset($_REQUEST['btn-update'])) {
    $id = $_REQUEST['id'];
    $Name = $_REQUEST['Name'];
    $Age = $_REQUEST['Age'];
    $Job_Title = $_REQUEST['Job_Title'];
    $Department = $_REQUEST['Department'];
    $Email = $_REQUEST['Email'];
    $Contact = $_REQUEST['Contact'];

    $res = $config->updateEmployes($Name, $Age, $Job_Title, $Department, $Email, $Contact, $id);

    if ($res) {
        echo '
                        <div class="container pt-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                                        <strong>Updated!</strong> Record has been Updated successfully.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>';

        $fetch_emp = $config->fetchEmployes();

    } else {
        echo '
                <div class="container pt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                                <strong>Updated!</strong> Record Update failed. Please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>';

        $fetch_emp = $config->fetchEmployes();
    }
}

?>


?>


<!-- Emploes Ui Form -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parabiya Innovations - Employee Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            margin-bottom: 30px;
        }

        .btn-submit,
        .btn-reset {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="form-container mx-auto col-md-6">
            <h1 class="text-center">Employee Form</h1>

            <form action="" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?php if ($edit_emp_data != null) {
                    echo $edit_emp_data['id'];
                }
                ; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="Name" value="<?php if ($edit_emp_data != null) {
                        echo $edit_emp_data['Name'];
                    } ?>" placeholder="Enter Your Name" required>
                    <div class="invalid-feedback">Please enter your name.</div>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="Age" value="<?php if ($edit_emp_data != null) {
                        echo $edit_emp_data['Age'];
                    } ?>" placeholder="Enter Your Age" required min="18">
                    <div class="invalid-feedback">Please enter a valid age (18+).</div>
                </div>

                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" name="Job_Title" value="<?php if ($edit_emp_data != null) {
                        echo $edit_emp_data['Job_Title'];
                    } ?>" placeholder="Enter Your Job Title" required>
                    <div class="invalid-feedback">Please enter your job title.</div>
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="Department" value="<?php if ($edit_emp_data != null) {
                        echo $edit_emp_data['Department'];
                    } ?>" placeholder="Enter Your Department" required>
                    <div class="invalid-feedback">Please enter your department.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="Email" value="<?php if ($edit_emp_data != null) {
                        echo $edit_emp_data['Email'];
                    } ?>" placeholder="Enter Your Email" required>
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="tel" class="form-control" id="contact" name="Contact" value="<?php if ($edit_emp_data != null) {
                        echo $edit_emp_data['Contact'];
                    } ?>" placeholder="Enter Your Contact" required pattern="[0-9]{10}">
                    <div class="invalid-feedback">Please enter a valid 10-digit contact number.</div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn <?php if ($edit_emp_data != null) {
                            echo "btn-primary";
                        } else {
                            echo "btn-warning";
                        } ?>" name="<?php if ($edit_emp_data != null) {
                             echo "btn-update";
                         } else {
                             echo "btn-submit";
                         } ?>">
                            <?php if ($edit_emp_data == null) { ?>
                                Submit
                            <?php } else { ?>
                                Update
                            <?php } ?>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="reset" class="btn btn-success btn-reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap form validation
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>
<br></br>
<br></br>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Job Title</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($fetch_emp)) { ?>
                        <tr>
                            <td><?php echo $result['Id'] ?></td>
                            <td><?php echo $result['Name'] ?></td>
                            <td><?php echo $result['Age'] ?></td>
                            <td><?php echo $result['Job_Title'] ?></td>
                            <td><?php echo $result['Department'] ?></td>
                            <td><?php echo $result['Email'] ?></td>
                            <td><?php echo $result['Contact'] ?></td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="edit_id" value="<?php echo $result['Id'] ?>">
                                    <button class="btn btn-warning btn-sm" name="btn_edit">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="delete_id" value="<?php echo $result['Id'] ?>">
                                    <button class="btn btn-danger btn-sm" name="btn_delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- old UI design -->

<!-- <div class="col col-5">
    <table class="table table-striped">

        <head>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Job_Title</th>
                <th>Department</th>
                <th>Email</th>
                <th>Contact</th>
                <th colspan="2">Action</th>
            </tr>
        </head>
    </table>
    <tbody>
        <?php while ($result = mysqli_fetch_assoc($fetch_emp)) { ?>
            <tr>
                <td><?php echo $result['Id'] ?></td>
                <td><?php echo $result['Name'] ?></td>
                <td><?php echo $result['Age'] ?></td>
                <td><?php echo $result['Job_Title'] ?></td>
                <td><?php echo $result['Department'] ?></td>
                <td><?php echo $result['Email'] ?></td>
                <td><?php echo $result['Contact'] ?></td>
                <form method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $result['Id'] ?>">
                        <td><button class="btn btn-warning" name="btn_edit">Edit</button></td>
                </form>
                <td>
                    <form method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $result['Id'] ?>">
                    <td><button class="btn btn-danger" name="btn_delete">Edit</button></td>
                    </form>
                </td>
            </tr>

        <?php } ?>
    </tbody>

</div> -->


<!-- noramel Ui 1 -->

<!-- <!DOCTYPE html>
<html>
<html>
<head>
    <title>Parabiya Innovations</title>
</head>
<body>
    <h1>Employes Form</h1>

    <form action="" method="POST">
        
    Name :
    <input type="text" class="from-control" name="Name" placeholder="Enter Your Name"> <br>
    Age :
    <input type="number" class="from-control" name="Age" placeholder="Enter Your Age"> <br>
    Job_Title :
    <input type="text" class="from-control" name="Job_Title" placeholder="Enter Your Job Title"> <br>
    Department :
    <input type="text" class="from-control" name="Department" placeholder="Enter Your Department"> <br>
    Email :
    <input type="email" class="from-control" name="Email" placeholder="Enter Your Email"> <br>
    Contact :
    <input type="number" class="from-control" name="Contact" placeholder="Enter Your Contact"> <br>

    <div class="text-center">
        <button class="btn btn-primary" name="btn-submit">Submit</button>
        <button class="btn btn-success" >Reset</button>

    </div>

    </from>

    
</body>
</html>
</html> -->