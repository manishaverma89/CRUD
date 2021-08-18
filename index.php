<!-- Connection To Database -->
<?php
      
 $insert = false;   
// echo "Welcome!! we're ready to get connected to a Database<br><br>";
// Ways to connect to a MySql Database
// we are using MySqli extension
//Connection to the database
// we need 3 variables

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "notes";
// Create a connection
$conn = mysqli_connect($servername,$username,$password,$dbname);      

// die if connection was unsuccessfull
if (!$conn){
   die("sorry we failed to connect ". mysqli_connect_error());
}
// else{
// echo "Great!! connection was successfull";
// }


 //  select query
//  $sql = "SELECT * FROM notes";
//  $result = mysqli_query($conn,$sql);

//  if ($result){
//  echo "successfull";
//  }
//  else {
//    echo "not successfull:-->" . mysqli_error($conn);
//  }


//  INSERTION

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = $_POST['title'];
  $desc =  $_POST['desc'];
  // $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ($title , $desc)";
     $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title', '$desc')" ;
     $result = mysqli_query($conn,$sql);
 if ($result){
  //  echo "successfull";
  $insert = true;
 }
 else {
   echo "not successfull:-->" . mysqli_error($conn);
 }
//  echo " hii Insertion is working";

}

//  mysqli_close($conn);
 ?>
 

    
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>PHP CRUD Project</title>
  </head>
  <body>
      <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">iNotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>

              </ul>

            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <!-- Alert  -->
      
        <?php if($insert){   ?>
        <?php echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
         <strong>Success!</strong> Your Note has been added successfully.
         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>"; ?>
       <?php }  ?>
      

      <!-- FORM -->
      <div class="container my-5  ">
          <h2>Add a Note</h2>
        <form action="/crud/index.php" method="post">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" placeholder="add a note title here"id="title"  name="title" aria-describedby="emailHelp">
             
            </div>
            <div class="mb-3">
                <label for="desc">Note Description</label>
                <textarea class="form-control" placeholder="write description here" id="desc" name="desc"></textarea>
              </div>
          
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
        </div>

        <!-- PHP code -->

   <div class="container">
           

<!-- BOOTSTRAP Table -->

<table class="table">

  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  
  </thead>
 <tbody>


  <?php 
    $sql = "SELECT * FROM notes";
    $result = mysqli_query($conn,$sql);
  ?>

       <?php while ($row = mysqli_fetch_assoc($result)){  ?>
        <tr>
          <td> <?php echo $row['sno'];  ?> </td>
          <td> <?php echo $row['title']; ?> </td>
          <td> <?php echo $row['description']; ?> </td>
          <td>  @Actions </td>
        </tr>
         
       <?php   }   ?>
      
      </tbody>
      
     </table>
                     
         </div>
             

      
      
  
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>