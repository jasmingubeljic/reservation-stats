<?php require __DIR__ . "/includes/collector.php"; ?>
<?php
    $stats = Reservation::getReservationStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasmin Gubeljic - Task</title>
</head>
<body>
    <h1>Statistika rezervacija</h1>
    <h2>Prosječno trajanje rezervacija (u danima):</h2>
    <p>99</p>
    
    <h2>Top 5 mjesta (po duljini trajanja rezervacije):</h2>
    <p>99</p>

    <h2>Top 5 rivijera (po duljini trajanja rezervacije):</h2>
    <p>99</p>

    <h2>Ukupan prihod od rezervacija po godini:</h2>
    <p>99</p>

    <h2>Lista gostiju koji su rezervirali više od jednom (poredanih od najvećeg broja ostvarenih
    rezervacija prema najmanjem):</h2>
    <p>99</p>

    <?php print_r($stats) ?>
    
</body>
</html>
