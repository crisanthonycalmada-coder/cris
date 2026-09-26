<?php

session_start();


if (!isset($_SESSION['students_id'])) {
    header("Location: login.php");
    exit();
}




include 'database.php';



$query = "SELECT Id, FirstName, username, password FROM students";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Management</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- YOUR CSS -->

    <link rel="stylesheet" href="style.css">

</head>


<body>


<!-- =====================================
     STARS
===================================== -->

<div class="star star1"></div>
<div class="star star2"></div>
<div class="star star3"></div>
<div class="star star4"></div>
<div class="star star5"></div>
<div class="star star6"></div>
<div class="star star7"></div>
<div class="star star8"></div>
<div class="star star9"></div>
<div class="star star10"></div>
<div class="star star11"></div>
<div class="star star12"></div>
<div class="star star13"></div>
<div class="star star14"></div>
<div class="star star15"></div>
<div class="star star16"></div>
<div class="star star17"></div>
<div class="star star18"></div>
<div class="star star19"></div>
<div class="star star20"></div>
<div class="star star21"></div>
<div class="star star22"></div>
<div class="star star23"></div>
<div class="star star24"></div>
<div class="star star25"></div>
<div class="star star26"></div>
<div class="star star27"></div>


<!-- =====================================
     SHOOTING STARS
===================================== -->

<div class="shooting-star"></div>
<div class="shooting-star2"></div>


<!-- =====================================
     MAIN CONTAINER
===================================== -->

<div class="container mt-5">


    <!-- =================================
         HEADER
    ================================== -->

    <div class="mb-4">

        <h2>Student Management</h2>

        <p style="color: white;">

            Welcome,

            <strong>

                <?php

                echo htmlspecialchars(
                    $_SESSION['FirstName']
                );

                ?>

            </strong>

            !

        </p>

    </div>


    <!-- =================================
         BUTTONS
    ================================== -->

    <div class="mb-3">


        <!-- ADD STUDENT -->

        <a
            href="index.php"
            class="btn btn-primary">

            Add Student

        </a>


        <!-- LOGOUT -->

        <a
            href="logout.php"
            class="btn btn-danger"
            onclick="return confirm('Are you sure you want to logout?');">

            Logout

        </a>

    </div>


    <!-- =================================
         STUDENT TABLE
    ================================== -->

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>First Name</th>

                    <th>Username</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>


            <?php if ($result->num_rows > 0) { ?>


                <?php while ($row = $result->fetch_assoc()) { ?>


                    <tr>


                        <!-- ID -->

                        <td>

                            <?php

                            echo htmlspecialchars(
                                $row['Id']
                            );

                            ?>

                        </td>


                        <!-- FIRST NAME -->

                        <td>

                            <?php

                            echo htmlspecialchars(
                                $row['FirstName']
                            );

                            ?>

                        </td>


                        <!-- USERNAME -->

                        <td>

                            <?php

                            echo htmlspecialchars(
                                $row['username']
                            );

                            ?>

                        </td>


                        <!-- ACTION -->

                        <td>


                            <!-- EDIT -->

                            <a
                                href="index.php?id=<?php echo $row['Id']; ?>"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>


                            <!-- DELETE -->

                            <a
                                href="delete.php?id=<?php echo $row['Id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this student?');">

                                Delete

                            </a>


                        </td>


                    </tr>


                <?php } ?>


            <?php } else { ?>


                <tr>

                    <td
                        colspan="4"
                        class="text-center">

                        No students found.

                    </td>

                </tr>


            <?php } ?>


            </tbody>

        </table>

    </div>


</div>


<!-- =====================================
     BOOTSTRAP JAVASCRIPT
===================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>