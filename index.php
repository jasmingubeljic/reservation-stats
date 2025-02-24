<?php require __DIR__ . "/includes/collector.php"; ?>
<?php $stats = Reservation::getReservationStats(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Statistics</title>
    <link rel="stylesheet" type="text/css" href="styles/basic.css">
</head>
<body>
    <header>
        <h1>Reservations</h1>
        <p class="author">Statistics Calculation</p>
    </header>
    <main>
        <?php include_once('./includes/statistics_layout.php') ?>
    </main>
    
</body>
</html>
