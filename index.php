<style>
  .button {
    display: inline-block;
    background-color: royalblue;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 10px;
    border: none;
    border-radius: 150px;
    cursor: pointer;
  }
</style>

<?php include_once "header.php" ?>
<div class="container-fluid al">
  <div id="clock"></div>
  <br />
  <p class="timkiemnhanvien"><b>Search Feedback:</b></p>
  <br /><br />
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter feedback..." /><i class="" aria-hidden="true"></i>

  <form action=""></form>
  <div class="table-title">
    <div class="row"></div>
  </div>
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr class="ex">
        <th width="50%">Post Title</th>
        <th width="10%">Feedback</th>
        <th width="10%">Category</th>
        <th width="10%">Department</th>
        <th width="10%">Day Submited</th>
        <th width="20%">Comment</th>
      </tr>
    </thead>
    <?php
    include_once("config.php");
    if (isset($_SESSION["username"])) {
      $us = $_SESSION["username"];
      $sqlString = "SELECT * from tbl_account where email= '$us'";
      $result = mysqli_query($conn, $sqlString);
      $row2 = mysqli_fetch_array($result);
      $department = $row2["department_Id"];
      $account = $row2["account_Id"];
    }
    if ($row2["role"] == 1) {
      // Show all posts, regardless of department
      $sql = "SELECT tp.*, tc.categoryName, td.departmentName
              FROM tbl_post tp, tbl_category tc, tbl_department td
              WHERE tp.category_Id = tc.category_Id 
                AND tp.department_Id = td.department_Id";
    } else {
      $sql = "SELECT tp.*, tc.categoryName, td.departmentName
            FROM tbl_post tp, tbl_category tc, tbl_department td
            WHERE tp.category_Id = tc.category_Id 
              AND tp.department_Id = td.department_Id 
              AND tp.department_Id = '$department'";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
      <tbody>
        <tr>
          <td><?php echo $row["title"] ?></td>
          <td style="text-align: center;">
            <?php

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $timestamp = time() + 7 * 60 * 60;
            if (strtotime($row["date_ending"]) >= $timestamp) {
            ?>

              <button class="button" onclick="window.location.href='feedback.php?id=<?php echo $row['post_Id']; ?>'">
                Feedback
              </button>

            <?php
            } else {
              echo "Out of date";
            }

            ?>
          </td>
          <td style="text-align: center"><?php echo $row["categoryName"] ?></td>
          <td style="text-align: center"><?php echo $row["departmentName"] ?></td>

          <td style="text-align: center"><?php echo $row["date_ending"] ?></td>
          <td style="text-align: center;">
            <?php

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $timestamp = time() + 7 * 60 * 60;
            if (strtotime($row["date_end_read"]) >= $timestamp) {
            ?>

              <button class="button" onclick="window.location.href='listfeedback.php?id=<?php echo $row['post_Id']; ?>'">
                Comment

              <?php
            } else {
              echo "Out of date comment";
            }

              ?>
          </td>
          </td>
        </tr>
      <?php
    }
      ?>
      </tbody>
  </table>
  <?php include_once "footer.php" ?>
  <script type="text/javascript" src="js/main.js"></script>
