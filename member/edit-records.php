<!-- <?php
require_once('../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $q = "SELECT * FROM menber_records WHERE id='$id' ";

    $q = mysqli_query($con, $q);

    $contact = mysqli_fetch_assoc($q);
}


// edit record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $garbagetype = $_POST['garbage_type'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Update the record in the database
    $query = "UPDATE menber_records SET garbageType='$garbagetype', quantity='$quantity', amount='$amount', date='$date' WHERE id='$id'";
    mysqli_query($con, $query);



    if (mysqli_query($con, $query)) {
        Header('Location:records.php ?id=' . $id);
    } else die(mysqli_error($con));
}
?> -->