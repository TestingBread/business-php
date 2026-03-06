<?php
require 'connect.php';
$sql_select = "select * from country order by CountryCode";
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();
if (isset($_POST['submit'])) {
    if (!empty($_POST['CustomerID']) && !empty($_POST['Name'])) {
        $sql = "insert into customer (CustomerID,Name,CountryCode,OutstandingDebt,Email,Birthdate)
        values (:CustomerID,:Name,:CountryCode,:OutstandingDebt,:Email,:Birthdate,))";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user reg</title>
</head>

<body>
    <h1>Add customer but not in order of columns</h1>

    <form action="addcustomer_dropdown.php" method="POST">
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
        <label>outstandingdebt</label><br>
        <input type="number" placeholder="outstanding debt" name="OutstandingDebt">
        <br> </br>

        <label>select country code</label>
        <select name="CountryCode">
            <?php
            require 'connect.php';

            //txt
            while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)):;
            ?>
                <option value="<?php echo $cc["CountryCode"];    ?>">
                    <?php echo $cc["CountryName"]; ?>
                </option>
            <?php
            endwhile;
            ?>
        </select>

        <input type="submit" value="submit" name="submit">

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