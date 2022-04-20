<header>
    <div class="container">
        <h1>Teilnehmerliste</h1>
    </div><!-- / container -->
</header>
<main>
    <div class="container">
        <section>
            <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['eventDate']) ?></h2>
            <?php
            if (count($data['participants']) > 0) {
            ?>
                <table class="table table-dark" id="participants">
                    <thead>
                        <tr>
                            <th>Nr.</th>
                            <th>Startzeit</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">AK</th>
                            <th class=" d-none d-sm-table-cell">Verein</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $gender = GENDER;
                        foreach ($data['participants'] as $part) {
                            $ageGroup = Utils::ageGroup($data['event']['date'], $part['year_of_birth']);
                            $number = $part['number'] ? $part['number'] : "tbd";
                            echo "<tr>
                <td>" . $number . "</td> 
                <td>" . $part['start_time'] . "</td>              
                <td>" . htmlentities($part['first_name']) . " " . ($part['hide_last_name'] ? (htmlentities($part['last_name'][0]) . ".") : htmlentities($part['last_name'])) . "</td>
                <td class='d-none d-md-table-cell'>" . $part['gender'] . " " . $ageGroup . "</td>
                <td class='d-none d-sm-table-cell'>" . htmlentities($part['team_name']) . "</td>
                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<div class='text-center'><p>Noch keine Teilnehmer registiert.</p></div>";
            }
            ?>
        </section>
        <section>
            <?php
            if (count($data['supporter']) > 0) {
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
    </div><!-- / container -->
</main>