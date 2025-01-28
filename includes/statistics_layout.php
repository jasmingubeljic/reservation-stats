<h2>Rezervacije</h2>
<h3>Prosjek trajanja rezervacija:</h2>
<table><tr><td style="text-align: left"><?php echo $stats['durationBasedStats']['average_duration'] . " dana"; ?></td></tr></table>

<h3>Top 5 mjesta (prema duljini trajanja rezervacije):</h2>
<table>
    <tr>
        <th></th>
        <th>Mjesto</th>
        <th>Prosjek (u danima)</th>
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

<h3>Top 5 rivijera (prema duljini trajanja rezervacije):</h2>
<table>
    <tr>
        <th></th>
        <th>Rivijera</th>
        <th>Prosjek (u danima)</th>
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

<h2>Ukupan prihod od rezervacija po godini:</h2>
<table>
    <tr>
        <th>Godina</th>
        <th>Prihod</th>
        <th>Valuta</th>
    </tr>
    
    <?php 
        $keys = array_keys($stats['yearlyIncomeInEur']);
    
        for ($i=0; $i<count($keys); $i++) {
            $key = $keys[$i];
            $value = $stats['yearlyIncomeInEur'][$key];
            
            echo "<tr><td>$key</td><td>$value</td><td>EUR</td></tr>"; // ovdje je string  'EUR' hard-coded (mada je imamo među podacima). U stvarnom projektu bi trebala biti preuzeta sa api endpointa/db. 
        }
    ?>
</table>

<h2>Lista gostiju koji su rezervirali više od jednom (poredanih od najvećeg broja ostvarenih
rezervacija prema najmanjem):</h2>
<table>
    <tr>
        <th></th>
        <th>Ime i prezime</th>
        <th>Broj rezervacija</th>
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