<header class="text-center">

    <div class="container">
        <div class="mb-4">
            <?php
            foreach (array_reverse($data["allEventDates"]) as $eventDate) {
                echo "<a class='btn btn-light m-1 js-year-btn' id='$eventDate[id]' role='button' href='";
                echo DIR;
                echo  "events/results/", $eventDate['id'], "'>";
                echo  date("Y", strtotime($eventDate['date'])), "</a>";
            }
            ?>
        </div>
        <h1>Ergebnisse <?=  date("Y", strtotime($data['event']['date'])) ?></h1>
    </div>
</header>
<main>
    <div class="container">

        <section>
            <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['event']['date']) ?>
                <?php if (date("Y", strtotime($data['event']['date'])) == "2019") {
                    echo "<small><sup>*</sup></small>";
                }
                ?>
            </h2>
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
                        <th class="d-none d-md-table-cell">Nr.</th>
                        <th>Platz</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">AK</th>
                        <th class="d-none d-sm-table-cell">Verein</th>
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
                                if (isset($res['netto_finish_time']) && $res['netto_finish_time'] != "00:00:00") {
                                    $rankCounter++;
                                    $rank = $rankCounter;
                                    $time = $res['netto_finish_time'];

                                    $ageGroup = Utils::ageGroup($data['event']['date'], $res['year_of_birth']);
                                    echo "<tr>
                <td class='d-none d-md-table-cell'>" . $res['number'] . "</td>
                <td>" . $rank . "</td>
                <td>" . htmlentities($res['first_name']) . " " . ($res['hide_last_name'] ? (htmlentities($res['last_name'][0]) . ".") : htmlentities($res['last_name'])) . "</td>
                <td class='d-none d-md-table-cell'>" . $res['gender'] . " " . $ageGroup . "</td>
                <td class='d-none d-sm-table-cell'>" . htmlentities($res['team_name']) . "</td>
                <td>" . date("H:i:s", strtotime($time)) . "</td>
                </tr>";
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php if (date("Y", strtotime($data['event']['date'])) == "2019") {
                echo "<p><sup>*</sup> Wegen Baustelle abgeänderte <a href='https://www.alltrails.com/explore/map/1zf-2019?u=m' target='_blank'>Strecke</a></p>";
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
                    echo "<li>" . htmlentities($supporter['first_name']) . " " . ($supporter['hide_last_name'] ? (htmlentities($supporter['last_name'][0]) . ".") : htmlentities($supporter['last_name']));
                    if (isset($supporter["team_name"]) && strlen($supporter["team_name"]) > 0) {
                        echo " (" . htmlentities($supporter["team_name"]) . ")";
                    }
                    echo "</li>";
                }
                ?>
            </ul>
        </section>
    </div><!-- / Container -->
</main>

<script>
    $(document).ready(function() {
        //collect all buttons for year selection in an array
        var buttons = document.getElementsByClassName("js-year-btn");
        //loop through the array and compare button href with the current url
        //set the button to outline == current url
        for (var i = 0; i < buttons.length; i++) {
            if (window.location.href == ($(buttons[i]).attr("href"))) {
                $(buttons[i]).removeClass('btn-light')
                $(buttons[i]).addClass('btn-outline-light')
            }
        }
    });

    //autocomplete for team field
    $(document).ready(function() {
        $("#team").autocomplete({
            source: '<?= DIR ?>registration/autocompleteForTeams'
        });
    });
    // Vereinsfilter für Ergebnisse
    $(document).ready(function() {
        $("#team").keyup(function() {
            $.getJSON(
                '<?= DIR ?>events/resultsPerTeam/<?= $data['eventDateId'] ?>/' + $("#team").val(),
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

                                    tableBody += "<tr><td class='d-none d-md-table-cell'>" + item.number + "</td>";
                                    tableBody += "<td>" + rank + "</td>";
                                    tableBody +=
                                        "<td>" + item.first_name + " " + item.last_name + "</td>";
                                    tableBody += "<td class='d-none d-md-table-cell'>" + gender + " " + ageGroup + "</td>";
                                    tableBody += "<td class='d-none d-sm-table-cell'>" + teamName + "</td>";
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