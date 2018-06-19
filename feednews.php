<?php
function date3339($timestamp=0) {
    if (!$timestamp) {
        $timestamp = time();
    }

    $date = date('Y-m-d\TH:i:s', $timestamp);

    $matches = array();
    if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
        $date .= $matches[1].$matches[2].':'.$matches[3];
    } else {
        $date .= 'Z';
    }

    return $date;
}

header('Content-type: text/xml');

$link = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('project_bet') or die('Could not select database');

$query = 'SELECT p.product_id,p.product_name,p.description,p.current_price,p.insert_date,us.username FROM products p
JOIN users_products u ON p.product_id=u.product_id
JOIN users us ON u.user_id=us.user_id ORDER BY p.insert_date DESC
LIMIT 15';

$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo "<?xml version='1.0' encoding='UTF-8' ?>";
?>
<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
    <title>News Feed</title>
    <subtitle>The auctions from the AuctioX</subtitle>
    <link href="http://localhost:1235/Auctiox/feednews.php" rel="self"/>
    <updated><?php echo date3339(); ?></updated>
    <author>
        <name>Mada+Ioana</name>
    </author>
    <id>
        tag:AuctioX,2018:http://localhost:1235/Auctiox/feednews.php
    </id>


    <?php
    $i = 0;
    while($row = mysql_fetch_array($result))
    {
        if ($i > 0) {
            echo "</entry>";
        }

        $articleDate = $row['insert_date'];
        $articleDateRfc3339 = date3339(strtotime($articleDate));
        echo "<entry>";
        echo "<title>";
        echo $row['product_name'];
        echo "</title>";
        echo "<link type='text/html'
                    href='http://localhost:1235/Auctiox/home.php?
                    id=".$row['product_id']."'/>";
        echo "<description>";
        echo $row['description'];
        echo "</description>";
        echo "<current_price>";
        echo $row['current_price'];
        echo "</current_price>";
        echo "<date>";
        echo $row['insert_date'];
        echo "</date>";


        echo "<id>";
        echo "tag:AuctioX,2018:http://localhost:1235/Auctiox/home.php?id=".$row['product_id'];
        echo "</id>";


        echo "<updated>";
        echo $articleDateRfc3339;
        echo "</updated>";

        echo "<author>";
        echo "<name>";
        echo $row['username'];
        echo "</name>";
        echo "</author>";
        /*
        echo "<summary>";
        echo $row['subtitle'];
        echo "</summary>";
        */
        $i++;
    }
    ?>
    </entry>
</feed>
