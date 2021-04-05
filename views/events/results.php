<header>
    <h1>Ergebnisse</h1>
</header>
<main>

    <section>
        <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['event']['date']) ?></h2>

    </section>
    <section>
        <p>
        <div class="form-group row">
            <label for="team" class="col-md-2 col-form-label">Verein oder Team:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="team" id="team" placeholder="Vereins- oder Teamname" value="<?= $team ?>">
            </div>
        </div>
        </p>
        <table class="table table-dark" id="results">
            <thead>
                <tr>
                    <th>Nr.</th>
                    <th>Platz</th>
                    <th>Name</th>
                    <th>AK</th>
                    <th>Verein</th>
                    <th>Zeit</th>
                </tr>
            </thead>
            <tbody id="resultsTableBody">
                <?php
                $gender = GENDER;
                for ($i = 0; $i < count($gender); $i++) {
                    if (count($data['results' . $gender[$i]]) > 0) {
                        $rankCounter = 0;
                        echo "<tr><td colspan='6'>";
                        echo Utils::fullGender($gender[$i]);
                        echo "</td></tr>";
                        foreach ($data['results' . $gender[$i]] as $res) {
                            if (isset($res['netto_finish_time'])) {
                                $rankCounter++;
                                $rank = $rankCounter;
                                $time = $res['netto_finish_time'];
                            } else {
                                $rank = "--";
                                $time = "dns/dnf";
                            }
                            $ageGroup = Utils::ageGroup($res['year_of_birth']);
                            echo "<tr>
                <td>" . $res['number'] . "</td>
                <td>" . $rank . "</td>
                <td>" . htmlentities($res['first_name']) . " " . htmlentities($res['last_name']) . "</td>
                <td>" . $res['gender'] . " " . $ageGroup . "</td>
                <td>" . htmlentities($res['team_name']) . "</td>
                <td>" . $time . "</td>
                </tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
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
</main>

<script>
    // autocomplete for team field
    $(document).ready(function() {
        $("#team").autocomplete({
            source: '<?= DIR ?>registration/autocompleteForTeams'
        });
    });
    // Vereinsfilter für Ergebnisse
    $(document).ready(function() {
        $("#team").on("keyup", function() {
            $.getJSON(
                '<?= DIR ?>events/resultsPerTeam/<?= $data["event"]["id"] ?>/' + $("#team").val(),
                function(data) {
                    $("#resultsTableBody").empty();
                    if (typeof data == "object") {
                        var tableBody;
                        for (i = 0; i < data["gender"].length; i++) {
                            var gender = data.gender[i];
                            if (data["results" + gender].length > 0) {
                                var rankCounter = 0;
                                var results = data["results" + gender];
                                var fullGender = fullgender(gender);
                                tableBody += "<tr><td colspan='6'>" + fullGender + "</td></tr>";
                                results.forEach(function(item, index) {
                                    if (
                                        typeof item.netto_finish_time !== undefined &&
                                        item.netto_finish_time !== null
                                    ) {
                                        rankCounter++;
                                        var rank = rankCounter;
                                        var finishTime = item.netto_finish_time;
                                    } else {
                                        var rank = "--";
                                        var finishTime = "dns/dnf";
                                    }

                                    if (item.team_name !== null) {
                                        var teamName = item.team_name;
                                    } else {
                                        var teamName = "";
                                    }
                                    ageGroup = agegroup(item.year_of_birth, "<?= AGEGROUPS ?>");

                                    tableBody += "<tr><td>" + item.number + "</td>";
                                    tableBody += "<td>" + rank + "</td>";
                                    tableBody +=
                                        "<td>" + item.first_name + " " + item.last_name + "</td>";
                                    tableBody += "<td>" + gender + " " + ageGroup + "</td>";
                                    tableBody += "<td>" + teamName + "</td>";
                                    tableBody += "<td>" + finishTime + "</td></tr>";
                                });
                            }
                        }

                        $("#resultsTableBody").append(tableBody);
                    } else {
                        $("#resultsTableBody").append("Keine Ergebnisse");
                    }
                }
            );
        });
    });
</script>