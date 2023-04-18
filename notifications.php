<?php
include("config.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <style>
        .round {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: relative;
            background: red;
            display: inline-block;
            padding: 0.1rem 0.2rem !important;
            margin: 0.1rem 0.2rem !important;
            left: -10px;
            top: 1px;
            z-index: 99 !important;
        }

        .round>span {
            color: white;
            display: block;
            text-align: center;
            font-size: 1rem !important;
            padding: 0 !important;
        }

        #list {

            display: none;
            top: 33px;
            position: absolute;
            right: 2%;
            background: #ffffff;
            z-index: 100 !important;
            width: 25vw;
            margin-left: -37px;

            padding: 0 !important;
            margin: 0 auto !important;


        }

        .message {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .message .name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .message .text {
            color: #999;
            margin-bottom: 5px;
        }

        .message .text1 {
            font-weight: bold;
            color: black;
            margin-bottom: 5px;
        }

        .message .time {
            font-size: 12px;
            color: #ccc;
        }
    </style>
</head>
<?php
if (isset($_SESSION["username"])) {
    $us = $_SESSION["username"];
    $sqlString = "SELECT * FROM tbl_account WHERE email = '$us'";
    $result = mysqli_query($conn, $sqlString);
    $row2 = mysqli_fetch_array($result);
    $account = $row2["account_Id"];
    // Get the department ID of the current user
    $department_id = $row2["department_Id"];
}

// Use a JOIN to get the comments from all users in the same department
$find_notifications = "SELECT c.*, a.fullname FROM tbl_comment c JOIN tbl_account a ON c.account_Id = a.account_Id WHERE a.department_Id = $department_id AND active = 1";

$result = mysqli_query($conn, $find_notifications);
$count_active = '';
$notifications_data = array();
while ($rows = mysqli_fetch_assoc($result)) {
    $count_active = mysqli_num_rows($result);
        $notifications_data[] = array(
            "comment_Id" => $rows['comment_Id'],
            "fullname" => $rows['fullname'],
            "content" => $rows['content'],
            "date_comment" => $rows['date_comment'],
        );
}




// Use a JOIN to get the post from all users in the same department
$find_post = "SELECT p.*, a.fullname  FROM tbl_post p JOIN tbl_account a ON p.account_Id = a.account_Id WHERE a.department_Id = $department_id AND active = 1";

$result1 = mysqli_query($conn, $find_post);
$count_active1 = '';
$post_data = array();
while ($rows1 = mysqli_fetch_assoc($result1)) {
    $count_active1 = mysqli_num_rows($result1);
    $post_data[] = array(
        "post_Id" => $rows1['post_Id'],
        "fullname" => $rows1['fullname'],
        "content" => $rows1['content'],
        "date_create" => $rows1['date_create']
    );
}
$count = $count_active = mysqli_num_rows($result) + $count_active1 = mysqli_num_rows($result1);
?>
<div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        <li><i class="fa fa-bell" id="over" data-value="<?php echo $count; ?>" style="z-index:-99 !important;font-size:15px;color:black;margin:1.5rem 0.4rem !important;"></i></li>
        <?php if (!empty($count_active) && !empty($count_active1)) { ?>
            <div class="round" id="bell-count" data-value="<?php echo $count; ?>"><span><?php echo $count; ?></span></div>
        <?php } ?>

        <?php if (!empty($count_active) && !empty($count_active1)) { ?>
            <div id="list" style="max-height: 300px; overflow-y: scroll;">
                <?php
                foreach ($notifications_data as $list_rows) {
                ?>
                    <div class="notifications">
                        <div class="message alert alert-warning" data-id=<?php echo $list_rows['comment_Id']; ?>>
                            <div class="content">
                                <div class="message">
                                    <span class="name"><?php echo $list_rows['fullname']; ?></span>
                                    <span class="text1">Commented on the post with the content</span>
                                    <span class="text">"<?php echo $list_rows['content']; ?>"</span>
                                                                       <span class="time">
                                        <?php
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $saved_time = $list_rows['date_comment'];
                                        $saved_timestamp = strtotime($saved_time);
                                        $time_diff = time() - $saved_timestamp;
                                        $days_diff = floor($time_diff / (24 * 60 * 60));
                                        $hours_diff = floor(($time_diff - $days_diff * 24 * 60 * 60) / (60 * 60));
                                        $minutes_diff = floor(($time_diff - $days_diff * 24 * 60 * 60 - $hours_diff * 60 * 60) / 60);

                                        if ($days_diff == 0 && $hours_diff == 0 && $minutes_diff == 0) {
                                            echo "just finished";
                                        } elseif ($days_diff == 0 && $hours_diff == 0) {
                                            echo $minutes_diff . " minute ago";
                                        } elseif ($days_diff == 0) {
                                            echo $hours_diff . " hour " . $minutes_diff . " minute ago";
                                        } else {
                                            echo $days_diff . " day " . $hours_diff . " hour " . $minutes_diff . " minute ago";
                                        }
                                        ?>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
                <?php
                foreach ($post_data as $list_rows1) { ?>
                    <div class="notifications">
                        <div class="message alert alert-warning" data-id1=<?php echo $list_rows1['post_Id']; ?>>
                            <div class="content">
                                <div class="message">
                                    <span class="name"><?php echo $list_rows1['fullname']; ?></span>
                                    <span class="text1">New post</span>
                                    <span class="text">"<?php echo $list_rows1['content']; ?>"</span>
                                    <span class="time">
                                        <?php
                                        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ thành giờ của Việt Nam
                                        $saved_time = $list_rows1['date_create'];
                                        $saved_timestamp = strtotime($saved_time);
                                        $time_diff = time() - $saved_timestamp;
                                        $days_diff = floor($time_diff / (24 * 60 * 60));
                                        $hours_diff = floor(($time_diff - $days_diff * 24 * 60 * 60) / (60 * 60));
                                        $minutes_diff = floor(($time_diff - $days_diff * 24 * 60 * 60 - $hours_diff * 60 * 60) / 60);

                                        if ($days_diff == 0 && $hours_diff == 0 && $minutes_diff == 0) {
                                            echo "just finished";
                                        } elseif ($days_diff == 0 && $hours_diff == 0) {
                                            echo $minutes_diff . " minute ago";
                                        } elseif ($days_diff == 0) {
                                            echo $hours_diff . " hour " . $minutes_diff . " minute ago";
                                        } else {
                                            echo $days_diff . " day " . $hours_diff . " hour " . $minutes_diff . " minute ago";
                                        }
                                        ?>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        <?php } ?>
    </ul>
</div>

<script>
    $(document).ready(function() {
        var ids = new Array();
        $('#over').on('click', function() {
            $('#list').toggle();
        });

        //Message with Ellipsis
        $('div.msg').each(function() {
            var len = $(this).text().trim(" ").split(" ");
            if (len.length > 12) {
                var add_elip = $(this).text().trim().substring(0, 65) + "…";
                $(this).text(add_elip);
            }

        });


        $("#bell-count").on('click', function(e) {
            e.preventDefault();

            let belvalue = $('#bell-count').attr('data-value');

            if (belvalue == '') {

                console.log("inactive");
            } else {
                $(".round").css('display', 'none');
                $("#list").css('display', 'block');

                $('.message').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: 'deactive.php',
                        type: 'POST',
                        data: {
                            "id": $(this).attr('data-id'),
                        },
                        success: function(data) {

                            console.log(data);
                            location.reload();
                        }
                    });
                });
                $('.message').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: 'postactive.php',
                        type: 'POST',
                        data: {
                            "id": $(this).attr('data-id1'),
                        },
                        success: function(data) {

                            console.log(data);
                            location.reload();
                        }
                    });
                });
            }
        });

    });
</script>
