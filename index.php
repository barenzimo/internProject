<?php  
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "baren";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    $name=$_POST["exampleInputname1"];
    $email = $_POST["exampleInputEmail1"];
    $password = $_POST["exampleInputPassword1"];
    $dob= $_POST["DOB"];
    $phone= $_POST["phone"];
    $hashPassword= password_hash($password, PASSWORD_DEFAULT);

    $sql="SELECT * FROM `user`  WHERE (`email`) LIKE '$email'";
    $result = mysqli_query($conn, $sql); 

    if(mysqli_num_rows($result)>0){
      $exist=true;
    }
    else if(mysqli_num_rows($result)==0) {
    $sql = "INSERT INTO `user` (`name`,`email`, `password`,`dob`,`phone`) VALUES ('$name','$email', '$hashPassword','$dob','$phone')";
    $result = mysqli_query($conn, $sql);
  
      if($result){ 
        $logged=true;
        setcookie("loggedin","$logged",time() +864000 ,"/");
        
        $_SESSION["loggedin"]=$logged;
        $_SESSION["username"]=$name;
        setcookie("username","$name",time() +864000 ,"/");
        
        $_SESSION["email"]=$email;
        setcookie("email","$email",time() +864000 ,"/");
        $_SESSION["password"]=$password;
        header('location: index.php');
      }
      else{
          echo "failed because of this error ---> ". mysqli_error($conn);
      } 
  }
  else{
    echo "failed because of this error ---> ". mysqli_error($conn);
  } 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Baren</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="styles.css" />

<body>
    <div class="">
        <!-- navbar  -->
        <div class="row mb-3 nav__color">
            <div class="col-10 mx-auto ">
                <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-end nav__color">
                    <div class="container-fluid nav__color">
                        <a class="navbar-brand brand nav__color">Baren</a>
                        <button class="navbar-toggler btn btn-outline-danger" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse mb-2 mb-lg-0 nav__color" id="navbarNavDropdown">
                            <!-- {/* Nav items */} -->
                            <ul class="navbar-nav ms-auto nav__color">
                                <li class="nav-item">
                                    <NavLink exact activeclass="when-active" class="nav-link active" aria-current="page"
                                        to="/">
                                        Home
                                    </NavLink>
                                </li>
                                <li class="nav-item">
                                    <NavLink activeclass="when-active" class="nav-link" to="/services">
                                        Services
                                    </NavLink>
                                </li>

                                <li class="nav-item">
                                    <NavLink activeclass="when-active" class="nav-link" to="/about">
                                        About
                                    </NavLink>
                                </li>
                                <li class="nav-item">
                                    <NavLink activeclass="when-active" class="nav-link" to="/contacts">
                                        Contacts
                                    </NavLink>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>




        </div>
        <!-- main section with carousel -->


        <div class="home container-fluid ">
            <div class="row">
                <div class="col-10 mx-auto home my-5">

                    <div class="row">
                        <div
                            class=" col-lg-6 col-md-12 order-2 order-lg-1   d-flex flex-column justify-content-center home__content">
                            <h1 class="mb- home__h1 mt-3 ">
                                Grow business with<br />
                                <span class="fw-bold h1__span ">Baren Soulutions</span>
                            </h1>
                            <p class="mb-2 home__p mediaHome__p mt-4">
                                I'm a freelance Web Developer proficent in making good UI
                                websites and and high optimized web Apps
                            </p>
                            <!-- {/* button */} -->
                            <div class="buttonStarted mt-4">
                                <NavLink class="btn btn-outline-danger btn-lg home__btn ">
                                    Get started
                                </NavLink>
                            </div>
                        </div>
                        <!-- carousel items -->
                        <div class="col-lg-6 col-md-12 order-1 order-lg-2  h-50 ">
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="10000">
                                        <img src="https://barenzimo.github.io/baren-Solutions/static/media/webDesign.45eeffbd.jpg"
                                            class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Web designing</h5>
                                            <p>Design your websites with best and experinced UI/UX designer.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="https://barenzimo.github.io/baren-Solutions/static/media/webDev.2558cce9.jpg"
                                            class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Web Development</h5>
                                            <p>Skilled in many technologies and a fullstack developer.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://barenzimo.github.io/baren-Solutions/static/media/softwareDev.4d0a4c8d.jpg"
                                            class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Software development</h5>
                                            <p>Also equipped with skills of software development with good understanding
                                                of Data Structures and Algorithms.</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- contact us -->
        <div class="row" id="contacts">
            <div class="col-10 mx-auto">
                <h1 class="mx-auto contact__h1 my-3">Contact US</h1>
                <!-- {/* form starting here */} -->
                <div class="contact__form  my-3">
                    <form action="./index.php" method="POST">
                        <div class="mb-3">
                            <!-- {/* fullname */} -->
                            <label for="exampleInputFullName" class="form-label">
                                Fullname
                            </label>
                            <input type="text" placeholder="Enter your full name" class="form-control"
                                id="exampleInputFullName" name="exampleInputname1" aria-describedby="emailHelp" />
                        </div>

                        <!-- /* email * -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">
                                Email
                            </label>
                            <input placeholder="example@email.com" type="email" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp" name="exampleInputEmail1" />
                        </div>

                        
                        <div class="mb-3">
                            <!-- {/* fullname */} -->
                            <label for="password" class="form-label">
                                password
                            </label>
                            <input type="password" class="form-control"
                                id="password" aria-describedby="emailHelp" name="exampleInputPassword1" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputSubject" class="form-label">
                                Date of birth
                            </label>
                            <input type="date" placeholder="eg. +912356" class="form-control" id="exampleInputSubject"
                                aria-describedby="emailHelp" name="DOB" />
                        </div>
                        <!-- {/* subject */} -->
                        <div class="mb-3">
                            <label for="exampleInputSubject" class="form-label">
                                Phone Number
                            </label>
                            <input type="number" placeholder="eg. +912356" class="form-control" id="exampleInputSubject"
                                aria-describedby="emailHelp" name="phone" />
                        </div>

                        <!-- <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea  class="form-control" id="exampleFormControlTextarea1"
                                rows="3" name="message"></textarea>
                        </div> -->

                        <button onClick={handleClick} type="submit" class="btn btn-outline-danger home__btn ">
                            Submit form
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="p-3">
                <h3 class="text-center mt-5 mb-3">Your Details</h3>
                <table class="table " id="myTable">
                        <thead>
                            <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Phone</th>
                            </tr>
                        </thead>
                        
                        <?php
                            $temp2=$_COOKIE['email'];
                            $sql = "SELECT * FROM `user`";
                            $result = mysqli_query($conn, $sql);
                            $sno = 0;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                    $sno = $sno + 1;
                                        echo '
                                    <tbody>
                                        <tr>
                                        <th scope="row">'. $sno . '</th>
                                        <td>'. $row['name'] . '</td>
                                        <td>'. $row["email"] . '</td>
                                        <td>'. $row["dob"] . '</td>
                                        <td>'. $row["phone"] . '</td>
                                        </tr>
                            ';
                            }
                            echo ' </tbody>
                        </table>';
                        ?>
        </div>


           <footer id="footer">

            <div class="footer__svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-facebook" viewBox="0 0 16 16">
                    <path
                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-instagram" viewBox="0 0 16 16">
                    <path
                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                </svg>
                <p>© Copyright <span class="copyright">2021</span> Baren </p>

            </div>

        </footer>

   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  -- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>

</html>