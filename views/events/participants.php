<header>
    <h1>Teilnehmerliste</h1>
</header>
<main>
    <section>
        <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['event']['date']) ?></h2>
        <table class="table table-dark" id="participants">
            <thead>
                <tr>
                    <th>Nr.</th>
                    <th>Startzeit</th>
                    <th>Name</th>
                    <th>AK</th>
                    <th>Verein</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $gender = GENDER;
                foreach ($data['participants'] as $part) {
                    $ageGroup = Utils::ageGroup($part['year_of_birth']);
                    $number = $part['number'] ? $part['number'] : "tbd";
                    echo "<tr>
                <td>" . $number . "</td> 
                <td>" . $part['start_time'] . "</td>              
                <td>" . htmlentities($part['first_name']) . " " . htmlentities($part['last_name']) . "</td>
                <td>" . $part['gender'] . " " . $ageGroup . "</td>
                <td>" . htmlentities($part['team_name']) . "</td>
                </tr>";
                }
                    
                ?>
            </tbody>
        </table>
    </section>
    <section>
        <?php 
        if(count($data['supporter']) > 0) {
            echo "<h1>Vielen Dank an die Helfer</h1>";
        }
        ?>
        <ul>
            <?php
            foreach ($data['supporter'] as $supporter) {
                echo "<li>" . htmlentities($supporter['first_name']) . " " . htmlentities($supporter["last_name"]);
                if (isset($supporter["team_name"]) && strlen($supporter["team_name"]) > 0) {
                    echo " (" . htmlentities($supporter["team_name"]) . ")";
                }
                echo "</li>";
            }
            ?>
        </ul>
    </section>
</main>