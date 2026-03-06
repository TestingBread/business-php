<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user regis</title>
</head>

<body>
    <h1>Add customer</h1>

    <form action="addcustomer.php" method="POST">
        <label>Customer ID</label><br>
        <input type="text" placeholder="Enter Customer ID" name="CustomerID">
        <br> </br>
        <label>Enter name</label><br>
        <input type="text" placeholder="Name" name="Name">
        <br> </br>
        <label>birthday</label><br>
        <input type="date" placeholder="birthday" name="Birthdate">
        <br> </br>
        <label>email</label><br>
        <input type="email" placeholder="email" name="Email">
        <br> </br>

        <label>country code</label><br>
        <input type="text" placeholder="countrycode" name="CountryCode">

        <br> </br>
        <label>outstandingdebt</label><br>
        <input type="text" placeholder="outstandingdebt" name="OutstandingDebt">
        <br> </br>
        <input type="submit">
    </form>


</body>


</html>

<?php
if (isset($_POST['CustomerID']) && isset($_POST['Name'])):

    require 'connect.php';
    $sql = "insert into customer values(:CustomerID, :Name, :Birthdate, :Email,
                :CountryCode, :OutstandingDebt)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CustomerID', $_POST['CustomerID']);
    $stmt->bindParam(':Name', $_POST['Name']);
    $stmt->bindParam(':Birthdate', $_POST['Birthdate']);
    $stmt->bindParam(':Email', $_POST['Email']);
    $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
    $stmt->bindParam(':OutstandingDebt', $_POST['OutstandingDebt']);

    if ($stmt->execute()):
        $message = 'suscessfully add new customer';
    else :
        $message = 'fail to add new customer';
    endif;
    echo $message;
    $conn = null;
endif;
?>