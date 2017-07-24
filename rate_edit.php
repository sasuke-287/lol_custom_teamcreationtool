<table border ="1">
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

//header("Content-Type: application/json; charset=utf-8");
echo "<title>A2Zカスタムチーム分けツール</title>";

    $json = file_get_contents("member.json");
    $arr = json_decode($json, true);

    $editmember = @$_POST["editbutton"];
    $editrate = @$_POST["rate"];

    if (isset($editrate)) {
        if (isset($editmember)) {
            $arr[$editmember] = $editrate;
            $newjson = json_encode($arr);
            file_put_contents("member.json" , $newjson);
            echo $editmember . "のレートを編集しました。";
        } else {
            echo "メンバーが指定されていません。";
        }
    } else {

        echo "<form action=\"rate_edit.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"editbutton\" value=".$editmember.">";

        echo "<thead><tr><th>名前</th><th>TOP補正値</th><th>JG補正値</th><th>MID補正値</th><th>ADC補正値</th><th>SUP補正値</th><th>基本値</th><th>編集</th></tr>";

        echo "<tr><th>" . $editmember . "</th>";
        echo "<th><input type=\"number\" name=\"rate[]\" ></th>";
        echo "<th><input type=\"number\" name=\"rate[]\" ></th>";
        echo "<th><input type=\"number\" name=\"rate[]\" ></th>";
        echo "<th><input type=\"number\" name=\"rate[]\" ></th>";
        echo "<th><input type=\"number\" name=\"rate[]\" ></th>";
        echo "<th><input type=\"number\" name=\"rate[]\" ></th>";
        echo "<th><input type=\"submit\"></th></tr>";

        echo "</form>";
    }