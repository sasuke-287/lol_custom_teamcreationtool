<table border ="1">
    <?php
    echo "<title>A2Zカスタムチーム分けツール</title>";
    $json = file_get_contents("member.json");
    $arr = json_decode($json, true);

    echo "<thead><tr><th>名前</th><th>TOP補正値</th><th>JG補正値</th><th>MID補正値</th><th>ADC補正値</th><th>SUP補正値</th><th>基本値</th></tr>";

    foreach ($arr as $key1 => $val1) {
        echo "<tr><th>" . $key1 . "</th>";

        foreach ($val1 as $key2 => $val2) {
            echo "<th>" . $val2 . "</th>";
        }
        echo "</tr>";
    }
        