<header>
    <h1>Teilnehmerliste</h1>
</header>
<main>
    <section>
        <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['event']['date']) ?></h2>
        <table class="table table-dark" id="participants">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>AK</th>
                    <th>Verein</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $gender = ["M", "W", "D"];
                for ($i = 0; $i < count($gender); $i++) {
                    if (count($data['participants' . $gender[$i]]) > 0) {
                        echo "<tr><td colspan='6'>";
                        echo Utils::fullGender($gender[$i]);
                        echo "</td></tr>";

                        foreach ($data['participants' . $gender[$i]] as $part) {
                            $ageGroup = Utils::ageGroup($part['year_of_birth']);
                            echo "<tr>
                <td></td>               
                <td>" . $part['first_name'] . " " . $part['last_name'] . "</td>
                <td>" . $part['gender'] . " " . $ageGroup . "</td>
                <td>" . $part['team_name'] . "</td>
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