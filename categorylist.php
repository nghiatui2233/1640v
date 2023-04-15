<?php include_once "header.php" ?>
<?php require_once "config.php";
?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Category:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter category..." /><i class="" aria-hidden="true"></i>

  <form action=""></form>
  <b>Main Function:</b><br />
  <button onclick="window.location='CreateCategory.php'" class="nv btn add-new" type="button" data-toggle="tooltip" data-placement="top" title="Add">
    <i class="fas fa-user-plus" aria-hidden="true"></i>
  </button>
  <div class="table-title">
    <div class="row"></div>
  </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="50%">Name</th>
        <th width="30%">Manage</th>
      </tr>
    </thead>
    <tbody>
      <?php //del button on pm 
      include_once("config.php");
      if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $sq = "SELECT categoryName from tbl_category WHERE category_Id='$id'";
          $res = mysqli_query($conn, $sq);
          mysqli_query($conn, "DELETE FROM tbl_category WHERE category_Id='$id'");
          echo '<meta http-equiv="refresh" content="0;URL =categorylist.php"/>';
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
      <?php
      $sql = "SELECT * FROM tbl_category";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <tr>
            <td style="text-align: center"><?php echo $row["categoryName"] ?></td>
            <td>
              <div class="text-center">
                <button class="btn btn-primary btn-sm edit" type="button" onclick="window.location.href='editcategory.php?id=<?php echo $row['category_Id']; ?>'">

                  <i class="fas fa-edit" style="color:black"></i>
                </button>
                <a href="?page=pm&&function=del&&id=<?php echo $row["category_Id"]; ?>" onclick="return deleteConfirm()"><span class="fas fa-trash" style="color:black"></span>
              </div>
            </td>
        <?php
        }
      }
        ?>
          </tr>
    </tbody>
  </table>
  <?php include_once "footer.php" ?>
  <script type="text/javascript" src="js/main.js"></script>
