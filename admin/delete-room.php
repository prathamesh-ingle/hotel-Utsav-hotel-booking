<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $roomId = intval($_GET['id']);

    $conn = new mysqli("localhost", "root", "", "hotel_utsav");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Optional: check if room exists before delete
    $stmt = $conn->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Redirect back with flag
header("Location: manage-rooms.php?deleted=1");
exit();
