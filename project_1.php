<?php

//INSERT INTO `notes` (`sno`, `tital`, `description`, `tstam`) VALUES (NULL, 0xbut books, 'please buy books from stor', current_timestamp())
$insert = false;
$update = false;
$delete = false;

// Connecting to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "note";

// Cerate  a connection 

$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful 
if (!$conn) {
  die("Sorry we failed to connect: " . mysqli_connect_errno());
}

// delete method

if (isset($_GET["delete"])) {
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

//post method

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    // upadte the record

    $sno = $_POST["snoEdit"];
    $tital = $_POST["titalEdit"];
    $description = $_POST["descriptionEdit"];

    $sql = "UPDATE `notes` SET `tital` = '$tital' ,  `description` = '$description' WHERE `notes`.`sno` = $sno";
    // Add a new trip to the trip in the database 
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "we could not update the record successfully";
    }
  } else {
    $tital = $_POST["tital"];
    $description = $_POST["description"];

    $sql = "INSERT INTO `notes` ( `tital`, `description`) VALUES ('$tital', '$description')";
    // Add a new trip to the trip in the database 
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // echo " the  record has been inserted  successfully  <br>";
      $insert = true;
    } else {
      echo " the  record was not create successfully  because of this error -----> " . mysqli_errno($conn);
    }
  }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous" />

  <title>php crud!</title>
</head>

<body>
  <!-- Edit modal -->

  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
 Edit modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="mt-5" method="post" action="">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <h2 class="">Update Note</h2>
            <div class="mb-3 ">
              <label for="tital">Note Tital</label>
              <input type="text" class="form-control" id="titalEdit" name="titalEdit" aria-describedby="emailHelp">
            </div>
            <div class="input-group">
              <span class="input-group">Note description</span>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>

      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
    <div class="container-fluid">
      <!-- <a class="navbar-brand text-white" href="#">PHP CRUD</a> -->
      <img src="php.png" alt="" height="60px" width="70px">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="#">Contact us</a>
          </li>
        </ul>
        <form class="d-flex ">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>

  <?php

  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> You note has been inserted Successfully!.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>

  <?php

  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success!</strong> You note has been Delete Successfully!.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>

  <?php

  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success!</strong> You note has been Update Successfully!.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>

  <div class="container">
    <form class="mt-5" method="post" action="">
      <h2 class="">Add a Note</h2>
      <div class="mb-3 ">
        <label for="tital">Note Tital</label>
        <input type="text" class="form-control" id="tital" name="tital" aria-describedby="emailHelp">
      </div>
      <div class="input-group">
        <span class="input-group">Note description</span>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
  </div>

  <div class="container mt-5">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno.</th>
          <th scope="col">Name</th>
          <th scope="col">description</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
                <th scope='row'>" . $sno . "</th>
                <td>" . $row['tital'] . "</td>
                <td>" . $row['description'] . "</td>
                <td> <button class=' edit  btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button>   
                <button class=' delete  btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button> 
                </td>
             </tr> ";
        }
        ?>
      </tbody>
    </table>
    <hr>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous">
  </script>
  <!-- jquery cdn -->
  <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
  <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>



  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        tital = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(tital, description);
        titalEdit.value = tital;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    });

    Deletes = document.getElementsByClassName('delete');
    Array.from(Deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete", );
        sno = e.target.id.substr(1, );
        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/php2/project_1.php?delete=${sno}`;
          // create a from and use post request to submit a form;
        } else {
          console.log("no");
        }

      })
    });
  </script>

  <script>
    let table = new DataTable('#myTable');
  </script>
</body>

</html>