<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $bookingId = intval($_GET['id']);
    $customerId = $_SESSION['customer_id'];

    $conn = new mysqli("localhost", "root", "", "hotel_utsav");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the booking belongs to this customer
    $check = $conn->prepare("SELECT id FROM bookings WHERE id = ? AND customer_id = ?");
    $check->bind_param("ii", $bookingId, $customerId);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 1) {
        $delete = $conn->prepare("DELETE FROM bookings WHERE id = ?");
        $delete->bind_param("i", $bookingId);
        $delete->execute();
    }

    $check->close();
    $conn->close();
}

// Redirect with toast trigger
header("Location: customer_dash.php?page=my-bookings&deleted=1");
exit();
