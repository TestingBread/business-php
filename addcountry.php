<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add country</title>
</head>

<body>
    <form action="addcountry.php" method="POST">
        <label>CountryCode</label><br>
        <input type="text" placeholder="Enter Country Code" name="CountryCode">
        <br> </br>

        <label>CountryName</label><br>
        <input type="text" placeholder="Enter country Name" name="CountryName">
        <input type="submit">
    </form>


</body>


</html>

<?php
if (isset($_POST['CountryCode']) && isset($_POST['CountryName'])):

    require 'connect.php';
    $sql = "insert into country values(:CountryCode, :CountryName)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
    $stmt->bindParam(':CountryName', $_POST['CountryName']);

    if ($stmt->execute()):
        $message = 'suscessfully add new country';
    else :
        $message = 'fail to add new country';
    endif;
    echo $message;
    $conn = null;
endif;
?>