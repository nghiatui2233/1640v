<?php include_once "header.php" ?>

<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Post:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter post..." /><i class="" aria-hidden="true"></i>

  <form action=""></form>
  <b>Main Function:</b><br />
  <button onclick="window.location='CreateFeedback.php'" class="nv btn add-new" type="button" data-toggle="tooltip" data-placement="top" title="Add Post">
    <i class="fas fa-user-plus" aria-hidden="true"></i>
  </button>
  <div class="table-title">
    <div class="row"></div>
  </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="40%">Title</th>
        <th>Department</th>
        <th>Category</th>
        <th>Create Date</th>
        <th>End Date</th>
        <th>End Comment</th>
        <th>Manage</th>
      </tr>
    </thead>
    <?php //del button on pm 
    include_once("config.php");
    if (isset($_GET["function"]) == "del") {
      if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT post_Id(s)
                                        FROM tbl_post
                                        JOIN tbl_category
                                        ON tbl_post.category_Id = tbl_category.category_Id;";
        mysqli_query($conn, "DELETE FROM tbl_post WHERE post_Id='$id'");
        echo '<meta http-equiv="refresh" content="0;URL =listpost.php"/>';
      }
    }
    ?>
    <tbody>
      <?php
      $sql = "SELECT tbl_post.*, tbl_category.categoryName, tbl_department.departmentName
          FROM tbl_post INNER JOIN tbl_category ON tbl_post.category_Id = tbl_category.category_Id
          INNER JOIN tbl_department ON tbl_department.department_Id = tbl_post.department_Id ";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <tr>
          <td><?php echo $row["title"] ?></td>
          <td style="text-align: center"><?php echo $row["departmentName"] ?></td>
          <td style="text-align: center"><?php echo $row["categoryName"] ?></td>

          <td style="text-align: center"><?php echo $row["date_create"] ?></td>
          <td style="text-align: center"><?php echo $row["date_ending"] ?></td>
          <td style="text-align: center"><?php echo $row["date_end_read"] ?></td>

          <td>
            <div class="text-center">
              <button class="btn btn-primary btn-sm edit" type="button" onclick="window.location.href='editpost.php?id=<?php echo $row['post_Id']; ?>'">

                <i class="fas fa-edit" style="color:black"></i>
              </button>
              <a href="?&&function=del&&id=<?php echo $row["post_Id"]; ?>" onclick="return deleteConfirm()"><span class="fas fa-trash" style="color:black"></span>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <?php include_once "footer.php" ?>
  <script type="text/javascript" src="js/main.js"></script>