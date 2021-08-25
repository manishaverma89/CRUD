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
    
    <!-- Adding Jquery CDN -->
     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- Adding CSS From datatables.net -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    
    
    

    <title>PHP CRUD Project</title>
  </head>
  <body>

      <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <!-- Edit Modal Form -->
          <form action="/crud/index.php" method="post">
          <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" placeholder="add a note title here"id="titleEdit"  name="titleEdit" aria-describedby="emailHelp">
             
            </div>
            <div class="mb-3">
                <label for="desc">Note Description</label>
                <textarea class="form-control" placeholder="write description here" id="descEdit" name="descEdit"></textarea>
              </div>
          
            <button type="submit" class="btn btn-primary">Update Note</button>
          </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    
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
        <div class="container my-4">
    <hr>
           

<!-- BOOTSTRAP Table -->

    <table class="table" id="myTable">

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
  
     

       <?php  $sno = 0 ;?>
       <?php while ($row = mysqli_fetch_assoc($result)){  ?>
       <?php  $sno = $sno +1 ; ?>
        <tr>
          <td> <?php echo $sno;  ?> </td>
          <td> <?php echo $row['title']; ?> </td>
          <td> <?php echo $row['description']; ?> </td>
          <td> <button class='edit btn btn-sm btn-primary' id= ".$row['sno'].">Edit</button> &nbsp;&nbsp; <a href="/delete">Delete</a>  </td>
         
         
        </tr>

        <?php   }   ?> 
         
      
      </tbody>
      
     </table>
     
       <!-- horizontal line -->
       <hr>
         </div>
             

      
      
  
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Adding Javascript from datatables.net -->
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    

    <!-- Call this single function from datatables.net -->
    <script>
         $(document).ready( function () {
         $('#myTable').DataTable();
         } );
     </script>


     <!-- JAvaScript for Edit Modal -->
     <script>
      edits = document.getElementsByClassName('edit');   //edit is class name
      Array.from(edits).forEach((element) =>{
      element.addEventListener("click" ,(e) =>{
        // console.log("Edit",e.target.parentNode.parentNode);
        console.log("Edit");
       
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[1].innerText;
        description = tr.getElementsByTagName("td")[2].innerText;
        console.log(title,description);
        titleEdit.value = title;
        descEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');    //$('#myModal').modal('toggle')

      })
   
      })
      
        

      

     </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>