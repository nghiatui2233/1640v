<?php include_once "header.php";
include_once("config.php"); ?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Staff:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter staff name..." /><i class="" aria-hidden="true"></i>

  <form action=""></form>
  <b>Main Function:</b><br />
  <button onclick="window.location='CreateStaff.php'" class="nv btn add-new" type="button" data-toggle="tooltip" data-placement="top" title="Add Account">
    <i class="fas fa-user-plus" aria-hidden="true"></i>
  </button>
    <div class="table-title">
      <div class="row"></div>
    </div>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr class="ex">
          <th>Full Name</th>
          <th>Gender</th>
          <th>Date of birth</th>
          <th>Address</th>
          <th>Phone number</th>
          <th>Email</th>
          <th>Manage</th>

        </tr>
      </thead>
      <?php //del button on pm 
      include_once("config.php");
      if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $sql = "SELECT * FROM tbl_account";
          mysqli_query($conn, "DELETE FROM tbl_account WHERE account_Id='$id'");
          echo '<meta http-equiv="refresh" content="0;URL =listpost.php"/>';
        }
      }
      ?>
        <script>
        function deleteConfirm() {
          if (confirm("Do you want to delete?")) {
            return true;
          } else {
            return false;
          }
        }
      </script>
      <tbody>
        <?php
        $sql = "SELECT * FROM tbl_account where role = 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
              <td><?php echo $row["fullname"] ?></td>
              <td style="text-align: center"><?php echo $row["gender"] ?></td>
              <td style="text-align: center"><?php echo $row["date_of_birth"] ?></td>
              <td style="text-align: center"><?php echo $row["address"] ?></td>

              <td style="text-align: center"><?php echo $row["phone"] ?></td>

              <td style="text-align: center"><?php echo $row["email"] ?></td>
              <td>
                <div class="text-center">
                  <button class="btn btn-primary btn-sm edit" type="button" onclick="window.location.href='editstaff.php?id=<?php echo $row['account_Id']; ?>'">

                    <i class="fas fa-edit" style="color:black"></i>
                  </button>
                  <a href="?&&function=del&&id=<?php echo $row["account_Id"]; ?>" onclick="return deleteConfirm()"><span class="fas fa-trash" style="color:black"></span>
                </div>
              </td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
    <?php include_once "footer.php" ?>
    <script type="text/javascript" src="js/main.js"></script>
