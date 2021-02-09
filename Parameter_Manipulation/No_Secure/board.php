<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
                <?php   
                    $conn = mysqli_connect("127.0.0.1", "root", "", "xss");

                    $stmt = $conn->prepare("select * from board_data where no=?");
                    @$stmt->bind_param("i", $_GET['board_no']);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $row = mysqli_fetch_assoc($res);
                ?>

                <h2><?=$row['title']?></h2>
                <p>작성자 : <?=$row['author']?> | 작성시간 : <?=$row['timestamp']?></p>
                <p><?=$row['body']?></p>
</body>
</html>