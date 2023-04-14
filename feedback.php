<?php include_once "header.php" ?>

<head>
  <style>
    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }

    html,
    body {
      background: #f1f1f1;
      font-family: "Merriweather", sans-serif;
      padding: 1em;
    }

    h1 {
      text-align: center;
      color: #a8a8a8;
      text-shadow: 1px 1px 0 rgba(255, 255, 255, 1);
    }

    form {
      max-width: 600px;
      text-align: center;
      margin: auto;
      margin-top: 70px;
    }

    input,
    textarea {
      border: 0;
      outline: 0;
      padding: 1em;
      border-radius: 8px;
      display: block;
      width: 100%;
      margin-top: 1em;
      font-family: "Merriweather", sans-serif;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
      resize: none;
    }

    input:focus,
    textarea:focus {
      box-shadow: 0 0px 2px rgba(231, 76, 60, 1) !important;
    }

    #input-submit {
      color: white;
      background: black;
      cursor: pointer;
    }

    #input-submit:hover {
      box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
    }

    textarea {
      height: 126px;
    }

    .half {
      float: left;
      width: 48%;
      margin-bottom: 1em;
    }

    .right {
      width: 50%;
    }

    .left {
      margin-right: 2%;
    }

    @media (max-width: 480px) {
      .half {
        width: 100%;
        float: none;
        margin-bottom: 0;
      }
    }

    /* Clearfix */
    .cf:before,
    .cf:after {
      content: " ";
      display: table;
    }

    .cf:after {
      clear: both;
    }

    .input-title {
      display: inline-block;
      font-weight: bold;
      margin-bottom: 5px;
      float: left;
      /* Đặt độ rộng cố định cho các title */
    }

    select {
      border: 0;
      outline: 0;
      padding: 1em;
      border-radius: 8px;
      display: block;
      width: 100%;
      margin-top: 1em;
      font-family: "Merriweather", sans-serif;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
      background: #fff;
    }

    select:focus {
      box-shadow: 0 0px 2px rgba(231, 76, 60, 1) !important;
    }

    input[type=file] {
      font-family: Arial, sans-serif;
      font-size: 10px;
      padding: 3px;
      border: 2px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }

    input[type=file]:hover {
      border-color: #666;
    }

    input[type=file]:focus {
      outline: none;
      border-color: #3399ff;
      box-shadow: 0 0 5px #3399ff;
    }

    input[type=file]::-webkit-file-upload-button {
      background-color: #3399ff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
    }

    input[type=file]::-webkit-file-upload-button:hover {
      background-color: #2672b8;
    }

    .download-button {
      display: inline-block;
      background-color: #3399ff;
      color: white;
      padding: 12px 24px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 300px;
      margin-left: 550px;
    }

    .download-button:hover {
      background-color: #2672b8;
    }
  </style>
</head>
<?php
include_once("config.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sqlString = "SELECT * from tbl_post where post_Id='$id'";

  $result = mysqli_query($conn, $sqlString);
  $row = mysqli_fetch_array($result);
?>
  <div class="post">
    <form>
      <div class="half left cf">
        <label class="input-title" for="input-title">Title:</label>
        <input type="text" value="<?php echo $row["title"]; ?>" readonly />
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <label class="input-title" for="input-title">Content:</label>
      <textarea name="message" type="text" placeholder="Message" readonly><?php echo $row["content"]; ?></textarea>
    </form>
    <input type="button" class="download-button" id="view-more" value="View More">
  </div>
<?php
}
include_once "submit-idea.php"
?>


<style>
  .hidden {
    display: none;
  }
</style>

<script>
  const viewMoreButton = document.getElementById("view-more");
  const contactForm = document.getElementById("contact-form");

  viewMoreButton.addEventListener("click", function(e) {
    e.preventDefault();
    if (contactForm.classList.contains("hidden")) {
      contactForm.classList.remove("hidden");
    } else {
      contactForm.classList.add("hidden");
    }
  });
</script>

<?php include_once "footer.php" ?>