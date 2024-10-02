<?php
echo "<h1> Success Page </h1>";
include "config/config.php";
$config = new Config();

$res = $config->fetchEmployes();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
</head>

<body>
    <div class="container pt-5">
        <h1>Dashboard</h1>
    </div>

    <div class="container">
        <table class="table table-hover  table-success table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Job_Title</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Contact</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($result = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo $result['Id'] ?></td>
                        <td><?php echo $result['Name'] ?></td>
                        <td><?php echo $result['Age'] ?></td>
                        <td><?php echo $result['Job_Title'] ?></td>
                        <td><?php echo $result['Department'] ?></td>
                        <td><?php echo $result['Email'] ?></td>
                        <td><?php echo $result['Contact'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>