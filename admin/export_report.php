<?php
$conn = new mysqli("localhost", "root", "", "hotel_utsav");

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

if (empty($from) || empty($to)) {
    die("Invalid date range.");
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=booking_report_{$from}_to_{$to}.xls");

echo "Customer\tEmail\tBooking Type\tDate\tStatus\tAssigned No\tMessage\n";

$stmt = $conn->prepare("SELECT b.*, c.full_name, c.email FROM bookings b JOIN customer c ON b.customer_id = c.id WHERE DATE(b.booking_date) BETWEEN ? AND ?");
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "{$row['full_name']}\t{$row['email']}\t{$row['booking_type']}\t{$row['booking_date']}\t{$row['status']}\t{$row['assigned_number']}\t" . str_replace(["\r", "\n"], " ", $row['message']) . "\n";
}
?>
