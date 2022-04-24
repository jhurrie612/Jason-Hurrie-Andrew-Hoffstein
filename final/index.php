<?php
include 'top.php';
?>
    <main>
        <h1>Top Quarterbacks</h1>
            <section class="qb">
                <h2>History</h2>
                <p>In 1962, a partial owner of the then Oakland Raiders, Bill Winkenbach, got together with some friends in a New York City hotel where they created the first ever Fantasy Football league called the GOPPPL, Greater Oakland Professional Pigskin Prognosticators League.</p>
                <p>Since then, Fantasy Football has sky-rocked and became one of the most popular things during the NFL season. According to the Fantasy Sports & Gaming Association, more than 60 million people around the world play fantasy sports and 70% of these people play fantasy football.</p>
                <p> In Fantasy Football, team owners will receive points based off of how their drafted players perform. They can receive points for a catch by a receiver, rushing yards from a running back, passing yards from their quarterback, touchdowns scored by anyone on their team, and much more. In a standard league, PPR league (points per reception) Jamaal Charles, the starting running back for the Kansas City Chiefs, has earned the crown for the most PPR fantasy points in a game. On December 15, 2013, Jamaal Charles scored 59.5 points against the Oakland Raiders. Not far behind Jamaal is Tyreek Hill who scored 57.9 points and is second on the all time list of PPR points in a single game when he faced the Tampa Bay Buccaneers on November 29th, 2020.</p>
                <p>Quarterbacks are typically the position that scores the most at the end of the fantasy football season. Because they can get points for passing yards, rushing yards, and touchdowns, quarterbacks such as Josh Allen, Justin Herbert, and Tom Brady each scored 417.7, 395.6, and 386,7 points during the 2021 NFL season respectfully. These high scoring quarterbacks are key players NFL Fantasy owners looks for when drafting their team.</p>
                <p>Below are some of the highest scoring quarterback performances of all time along with the highest cumulative career fantasy points. </p>
            </section>
            <section class="QBtable">
                <h2>All Time Quarterbacks</h2>
                <table>
                    <caption>Most Points in a Game</caption>
            
                    <tr>
                        <th>Quarterback</th>
                        <th>Game</th>
                        <th>Points</th>
                    </tr>
                    <?php
$sql = 'SELECT fldQuarterback, fldGame, fldPoints FROM tblQBtable';
$statement = $pdo->prepare($sql);
$statement->execute();

$records = $statement->fetchAll();

foreach ($records as $record) {
    print '<tr>';
    print '<td>' . $record['fldQuarterback'] . '</td>';
    print '<td>' . $record['fldGame'] . '</td>';
    print '<td>' . $record['fldPoints'] . '</td>';
    print '</tr>' . PHP_EOL;
}
?>
                    <tr>
                        <td colspan="3">Source: <cite><a href="https://www.statmuse.com/fantasy/ask/which-qb-has-the-most-fantasy-points-in-a-game" target="_blank">https://www.statmuse.com/fantasy/ask/which-qb-has-the-most-fantasy-points-in-a-game</a></cite></td>
                    </tr>
                </table>
                <figure class="fflogo">
                    <img alt="Fantasy Football Logo" src="images/fantasy-football.png">
                    <figcaption><cite><a href="https://a1.espncdn.com/combiner/i?img=%2Fi%2Fespn%2Fmisc_logos%2F500%2Fffl.png" target="_blank">Fantasy Football Logo</a></cite></figcaption>
                </figure>
                <h2>Cumulative Carrer Fantasy Points by a Quarterback</h2>
                <ol>
                <li>Tom Brady - 5,888.7 Points</li>
                <li>Drew Brees - 4,423.9 Points</li>
                <li>Peyton Manning - 4,947.1 Points</li>
                <li>Brett Farve - 4,803.2 Points</li>
                <li>Source: <cite><a href="https://www.statmuse.com/fantasy/ask/qb-with-most-fantasy-points" target="_blank">https://www.statmuse.com/fantasy/ask/qb-with-most-fantasy-points</a></cite></li>
                </ol>
            </section>
    </main>
<?php
include 'footer.php';
?>