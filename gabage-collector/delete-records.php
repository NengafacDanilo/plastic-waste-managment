<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // First get the image file path to delete
    $select_query = "SELECT pic FROM menber_records WHERE id = ?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()) {
        // Delete the image file if it exists
        $image_path = "uploads/" . $row['pic'];
        if(!empty($row['pic']) && file_exists($image_path)) {
            unlink($image_path);
        }
    }
    
    // Now delete the record
    $delete_query = "DELETE FROM menber_records WHERE id = ?";
    $stmt = $con->prepare($delete_query);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header('Location: records.php');
        exit();
    } else {
        echo "Error deleting record: " . $con->error;
    }
} else {
    echo "No record ID provided";
}

$con->close();
?>