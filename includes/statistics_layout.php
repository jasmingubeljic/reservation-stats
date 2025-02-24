<h2>Accommodation Reservations</h2>
<h3>Avg. reservation duration:</h2>
<table><tr><td style="text-align: left"><?php echo $stats['durationBasedStats']['average_duration'] . " dana"; ?></td></tr></table>

<h3>Top 5 places:</h2>
<table>
    <tr>
        <th></th>
        <th>Place</th>
        <th>Average (in days)</th>
    </tr>
        <?php
            $keys = array_keys($stats['durationBasedStats']['top_5_places']);
        
            for ($i=0; $i<count($keys); $i++) {
                $key = $keys[$i];
                $value = $stats['durationBasedStats']['top_5_places'][$key];
                $ordinalNo = $i+1 . ".";
                
                echo "<tr><td>$ordinalNo</td><td>$key</td><td>$value</td></tr>";
            }
        ?>
</table>

<h3>Top 5 rivieras (based on reservation duration):</h2>
<table>
    <tr>
        <th></th>
        <th>Riviera</th>
        <th>Average (in days)</th>
    </tr>
        <?php
            $keys = array_keys($stats['durationBasedStats']['top_5_rivieras']);
        
            for ($i=0; $i<count($keys); $i++) {
                $key = $keys[$i];
                $value = $stats['durationBasedStats']['top_5_rivieras'][$key];
                $ordinalNo = $i+1 . ".";
                
                echo "<tr><td>$ordinalNo</td><td>$key</td><td>$value</td></tr>";
            }
        ?>
</table>

<h2>Total income by year:</h2>
<table>
    <tr>
        <th>Year</th>
        <th>Income</th>
        <th>Currency</th>
    </tr>
    
    <?php 
        $keys = array_keys($stats['yearlyIncomeInEur']);
    
        for ($i=0; $i<count($keys); $i++) {
            $key = $keys[$i];
            $value = $stats['yearlyIncomeInEur'][$key];
            
            echo "<tr><td>$key</td><td>$value</td><td>EUR</td></tr>";
        }
    ?>
</table>

<h2>List of guests who have made more than one reservation (sorted from the highest number of bookings to the lowest):</h2>
<table>
    <tr>
        <th></th>
        <th>First name and Last name</th>
        <th>Number of reservations</th>
    </tr>
    <?php 
        $keys = array_keys($stats['returningGuests']);
    
        for ($i=0; $i<count($keys); $i++) {
            $key = $keys[$i];
            $value = $stats['returningGuests'][$key];
            $ordinalNo = $i+1 . ".";
            echo "<tr><td>$ordinalNo</td><td>$key</td><td>$value</td></tr>";
        }
    ?>
</table>