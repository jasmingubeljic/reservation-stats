<?php require __DIR__ . "/includes/collector.php"; ?>
<?php $stats = Reservation::getReservationStats(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasmin Gubeljic - Task</title>
</head>
<style>
    body {
        color:rgb(70, 70, 70);
        font-family: sans-serif;
        max-width: 1440px;
        margin: 0 auto;
    }
    h1, h2 {
        margin: 2rem 0 0;
    }
    .author {
        font-style: italic;
    }
</style>
<body>
    <header>
        <h1>Statistika rezervacija</h1>
        <p class="author">Jasmin Gubeljic ~ Task</p>
    </header>
    <main>
        <h2>Rezervacije</h2>
        <h3>Prosječno trajanje rezervacija:</h2>
        <ul><li><?php echo $stats['durationBasedStats']['average_duration'] . " dana"; ?></li></ul>
        
        <h3>Top 5 mjesta (po duljini trajanja rezervacije):</h2>
        <ol>
            <?php
                $keys = array_keys($stats['durationBasedStats']['top_5_places']);
            
                for ($i=0; $i<count($keys); $i++) {
                    $key = $keys[$i];
                    $value = $stats['durationBasedStats']['top_5_places'][$key];
                    
                    echo "<li>$key ($value dana)</li>";
                }
            ?>
        </ol>

        <h3>Top 5 rivijera (po duljini trajanja rezervacije):</h2>
        <ol>
            <?php 
                $keys = array_keys($stats['durationBasedStats']['top_5_rivieras']);
            
                for ($i=0; $i<count($keys); $i++) {
                    $key = $keys[$i];
                    $value = $stats['durationBasedStats']['top_5_rivieras'][$key];
                    
                    echo "<li>$key ($value dana)</li>";
                }
            ?>
        </ol>

        <h2>Ukupan prihod od rezervacija po godini:</h2>
        <ol>
            <?php 
                $keys = array_keys($stats['yearlyIncomeInEur']);
            
                for ($i=0; $i<count($keys); $i++) {
                    $key = $keys[$i];
                    $value = $stats['yearlyIncomeInEur'][$key];
                    
                    echo "<li>$key: $value EUR</li>";
                }
            ?>
        </ol>

        <h2>Lista gostiju koji su rezervirali više od jednom (poredanih od najvećeg broja ostvarenih
        rezervacija prema najmanjem):</h2>
        <ol>
            <?php 
                $keys = array_keys($stats['returningGuests']);
            
                for ($i=0; $i<count($keys); $i++) {
                    $key = $keys[$i];
                    $value = $stats['returningGuests'][$key];
                    
                    echo "<li>$key ($value rezervacije)</li>";
                }
            ?>
        </ol>
    </main>
    
</body>
</html>
