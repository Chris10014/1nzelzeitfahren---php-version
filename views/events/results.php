<header>
    <h1>Ergebnisse</h1>
</header>
<main>
    <section>
        <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['event']['date']) ?></h2>
        <table class="table table-dark" id="results">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Platz</th>
                    <th>Name</th>
                    <th>AK</th>
                    <th>Verein</th>
                    <th>Zeit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $gender = ["M", "W", "D"];
                for ($i = 0; $i < count($gender); $i++) {
                    if(count($data['results' . $gender[$i]]) > 0 ) {
                    $rankCounter = 0;
                    echo "<tr><td colspan='6'>";
                    echo Utils::fullGender($gender[$i]);
                    echo "</td></tr>";
                    foreach ($data['results' . $gender[$i]] as $res) {
                        if (isset($res['netto_finish_time']) and $res['team_name'] == "TSG Eppstein") {
                            $rankCounter++;
                            $rank = $rankCounter;
                        } elseif (isset($res['netto_finish_time']) and $res['team_name'] !== "TSG Eppstein") {
                            $rank = "außer Konkurrenz";
                        } else {
                            $rank = "--";
                        }
                        $ageGroup = Utils::ageGroup($res['year_of_birth']);
                        echo "<tr>
                <td></td>
                <td>" . $rank . "</td>
                <td>" . $res['first_name'] . " " . $res['last_name'] . "</td>
                <td>" . $res['gender'] . " " . $ageGroup . "</td>
                <td>" . $res['team_name'] . "</td>
                <td>" . $time = $res['netto_finish_time'] ?? "dns/dnf" . "</td>
                </tr>";
                    }
                }
                }
                ?>
            </tbody>
        </table>
    </section>
    <section>
        <h1>Vielen Dank an die Helfer</h1>
        <ul>
            <?php
            foreach ($data['supporter'] as $supporter) {
                echo "<li>" . $supporter['first_name'] . " " . $supporter["last_name"];
                if (isset($supporter["team_name"]) && strlen($supporter["team_name"]) > 0) {
                    echo " (" . $supporter["team_name"] . ")";
                }
                echo "</li>";
            }
            ?>
        </ul>
    </section>
</main>