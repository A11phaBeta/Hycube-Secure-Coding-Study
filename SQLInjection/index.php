<?php
if(isset($_POST['id']) && isset($_POST['pw'])){
    echo "id:".$_POST['id']."\npw:".$_POST['pw'];

    $conn = mysqli_connect('127.0.0.1', 'root', '', 'sql_injection') or die('Database Connection Error');

    $sql = "select count(*), user_id from user_information where user_web_id = '".$_POST['id']."' and user_web_password = '".$_POST['pw']."'";
    @$stmt->bind_param("ss", $_POST['id'], $_POST['pw']);
    $stmt->execute();

    $res = $stmt->get_result();

    $row = mysqli_fetch_assoc($res);
    

    echo "\ncount : ".$row['count(*)'];
}   
?>

<!-- Secure Code -->
<?php
if(isset($_POST['id']) && isset($_POST['pw'])){
    echo "id:".$_POST['id']."\npw:".$_POST['pw'];

    $conn = mysqli_connect('127.0.0.1', 'root', '', 'sql_injection') or die('Database Connection Error');

    $stmt = $conn->prepare("select count(*), user_id from user_information where user_web_id = ? and user_web_password = ?");
    @$stmt->bind_param("ss", $_POST['id'], $_POST['pw']);
    $stmt->execute();

    $res = $stmt->get_result();

    $row = mysqli_fetch_assoc($res);


    echo "\ncount : ".$row['count(*)'];
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection - Non Secure Coding</title>
</head>
<body>
    
    <form action="./index.php" method="post">

        <input type="text" name="id" placeholder="아이디를 입력해주세요.">
        <input type="password" name="pw" placeholder="비밀번호를 입력해주세요.">
        <input type="submit" value="로그인">
    </form>
</body>
</html>