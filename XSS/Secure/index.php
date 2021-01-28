<?php

    if(isset($_GET['query'])){
        switch($_GET['query']){
            case 'uploadBoard' :

                    //Secure code start
                    if(preg_match("/<script>/", $_GET['title']) || preg_match("/<script>/", $_GET['body']) || preg_match("/<script>/", $_GET['author'])){
                        echo "<script>alert('XSS Attack Detected');location.replace('./index.php');</script>"; exit;
                    }

                    $conn = mysqli_connect("127.0.0.1", "root", "", "xss");
                    $stmt = $conn->prepare("insert into board_data(title,body,author,timestamp) values(?,?,?,?)");

                    $date = date("Y-m-d H:i:s");
                    @$stmt->bind_param("ssss", $_GET['title'], $_GET['body'], $_GET['author'], $date);
                    $stmt->execute();
                    echo "hello";
                    echo "<script>location.replace('./index.php');</script>";
            break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h3 style="text-align:center">하이큐브 시큐어코딩 스터디 게시판</h3>
    </header>
    <article>
        <form style="margin-bottom:20px" action="./index.php" method="get">
            <input type="text" name="title" placeholder="제목" required>
            <input type="text" name="body" placeholder="내용" required>
            <input type="text" name="author" placeholder="작성자" required>
            <input type="hidden" name="query" value="uploadBoard">
            <input type="submit" value="글작성">
        </form>
        <table style="width:100%" border="1">
            <thead>
                <tr>
                    <th style="width:10%">번호</th>
                    <th style="width:50%">제목</th>
                    <th style="width:30%">작성자</th>
                    <th style="width:10%">업로드 시간</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $conn = mysqli_connect("127.0.0.1", "root", "", "xss");

                    $stmt = $conn->prepare("select * from board_data");
                    $stmt->execute();
                    $res = $stmt->get_result();

                    while($row = mysqli_fetch_assoc($res)){
                        echo 
                        "<tr>
                            <td>".$row['no']."</td>
                            <td><a href='./board.php?board_no=".$row['no']."'>".$row['title']."</a></td>
                            <td>작성자 : ".$row['author']."</td>
                            <td>".$row['timestamp']."</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </article>
    <footer></footer>
</body>
</html>