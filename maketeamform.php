    <?php
    echo "<title>A2Zカスタムチーム分けツール</title>";
    $json = file_get_contents("member.json");
    $arr = json_decode($json, true);

    echo "下記から10人チェックを入れ、送信ボタンを押してください<br>";
    $i =0;

    echo "<form action=\"maketeam.php\" method=\"post\">";
    
    foreach ($arr as $key1 => $val1) {
        echo  "<label for=\"sample_checkbox".$i."\"><input type=\"checkbox\" name=\"member[]\" value=".$key1." id=\"sample_checkbox".$i."\">".$key1."</label>";

        if($i % 5 == 4){
            echo "<br>";
        }
        $i++;
        
        
    }
    
    echo "<input type=\"submit\"><br>";
    echo "<input type=\"reset\" name=\"bt01\" value=\"リセットボタン\">";
    echo "</form>";
    
    echo "<a href=\"rate_list.php\">レートリスト</a><br>";
    
    echo "<a href=\"listedit.php\">編集画面</a>";
    
    
    echo "<br><br><br>何かありましたら<a href=\"https://twitter.com/sasuke_287\">@sasuke_287</a>まで";