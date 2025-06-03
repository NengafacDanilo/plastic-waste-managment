<?php
require_once('../config.php');

if(isset($_POST['record_id']) && isset($_POST['status'])) {
    $record_id = mysqli_real_escape_string($con, $_POST['record_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    // Update the record status
    $query = "UPDATE menber_records SET status = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $status, $record_id);
    
    if($stmt->execute()) {
        $_SESSION['success'] = "Record status updated successfully";
    } else {
        $_SESSION['error'] = "Error updating record status: " . $con->error;
    }
    
    $stmt->close();
} else {
    $_SESSION['error'] = "Missing required parameters";
}

// Redirect back to records page
header('Location: records.php');
exit();
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messages = document.querySelectorAll('.message');
        messages.forEach(message => {
            message.classList.add('fade-in');
            setTimeout(() => {
                message.classList.add('fade-out');
                setTimeout(() => {
                    message.style.display = 'none';
                }, 500); // Match this with the CSS transition duration
            }, 3000); // Display for 3 seconds
        });
    });
</script>