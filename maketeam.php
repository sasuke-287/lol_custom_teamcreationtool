<table border ="1">
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
  echo "<title>A2Zカスタムチーム分けツール</title>";
    $json = file_get_contents("member.json");
    $arr = json_decode($json, true);

    $ar_num = range(1, 10); //1から10の配列を取得
//$testmenber = array("sasuke","たかじぇ","もなつ","らーめん","あしゅりん","wtrnby","cine","カジバ","鈴木","のわの") ;//ここをユーザーからの入力で取得したいね
//$testmenber = array("sasuke","たかじぇ","もなつ","らーめん","あしゅりん","wtrnby","cine","カジバ","鈴木","のわの") ;
    
    $testmenber = @$_POST["member"] ;
      if (count($testmenber) == 10) {
//$testrate =   array(1500,1500,2000,1000,1000,500,2500,1000,500,500);
//$testrate =   array(1200,1100,1900,500,500,400,2000,500,500,400);
    $testrole; //ロールが入っている配列 01234　= topjgmidadcsup
    $topArate = null;
    $jgArate = null;
    $midArate = NULL;
    $adcArate = null;
    $supArate = null;

    shuffle($ar_num); //配列をシャッフル

    

//10人プルダウンメニューから選ぶ
//混ぜてから余りを取得することで0～4の数字がでる
//caseに応じてロール補正値を取得(配列の0～4がそれぞれロール補正値になるようにデータを作成すれば楽にできそう)
//それを各メンバーのロールLPとして記録。
//これで各メンバーのロールとロールレートは決定している。
//同じロールの二人は同じチームに入らないため、1チーム作るパターンは
//2^5=32通りに絞られる。(実質16通り)十分全パターン試せる範囲である。
//両側のレートの合計値を計算し　チームレート合計値の差を取得しソートする。
//ソートしたものを二分探索でレートの差が0に近いものを探し候補を複数出力する。
        for ($i = 0; $i < 10; $i++) {
            $member = $testmenber[$i];
            switch ($ar_num[$i] % 5) {//$arr[$member][5]は基本レートが入っている
                case 0:
                    //print "TOP/";
                    $testrole[$i] = 0;
                    $testrate[$i] = $arr[$member][5] + $arr[$member][0];
                    //ここでレートの補正値を組み込めたらよせそうだなぁ
                    break;
                case 1:
                    //print "JG/";
                    $testrole[$i] = 1;
                    $testrate[$i] = $arr[$member][5] + $arr[$member][1];
                    break;
                case 2:
                    //print "MID/";
                    $testrole[$i] = 2;
                    $testrate[$i] = $arr[$member][5] + $arr[$member][2];
                    break;
                case 3:
                    // print "ADC/";
                    $testrole[$i] = 3;
                    $testrate[$i] = $arr[$member][5] + $arr[$member][3];
                    break;
                case 4:
                    // print "SUP/";
                    $testrole[$i] = 4;
                    $testrate[$i] = $arr[$member][5] + $arr[$member][4];
                    break;
            }
        }



        for ($i = 0; $i < 10; $i++) {
            if ($testrole[$i] == 0) {
                if ($topArate == null) {
                    $topArate = $testrate[$i];
                    $topAname = $testmenber[$i];
                } else {
                    $topDiff = $topArate - $testrate[$i];
                    $topBname = $testmenber[$i];
                }
            }
            if ($testrole[$i] == 1) {
                if ($jgArate == null) {
                    $jgArate = $testrate[$i];
                    $jgAname = $testmenber[$i];
                } else {
                    $jgDiff = $jgArate - $testrate[$i];
                    $jgBname = $testmenber[$i];
                }
            }
            if ($testrole[$i] == 2) {
                if ($midArate == null) {
                    $midArate = $testrate[$i];
                    $midAname = $testmenber[$i];
                } else {
                    $midDiff = $midArate - $testrate[$i];
                    $midBname = $testmenber[$i];
                }
            }
            if ($testrole[$i] == 3) {
                if ($adcArate == null) {
                    $adcArate = $testrate[$i];
                    $adcAname = $testmenber[$i];
                } else {
                    $adcDiff = $adcArate - $testrate[$i];
                    $adcBname = $testmenber[$i];
                }
            }
            if ($testrole[$i] == 4) {
                if ($supArate == null) {
                    $supArate = $testrate[$i];
                    $supAname = $testmenber[$i];
                } else {
                    $supDiff = $supArate - $testrate[$i];
                    $supBname = $testmenber[$i];
                }
            }
        }

        /*
          echo "<br />";
          echo "<br />";
          echo "チームのレート差は";

          print $topDiff+$jgDiff+$midDiff+$adcDiff+$supDiff;
         */
        $teamDiff = array();

        $teamDiff[0] = $topDiff + $jgDiff + $midDiff + $adcDiff + $supDiff;
        $teamDiff[1] = $topDiff + $jgDiff + $midDiff + $adcDiff - $supDiff;
        $teamDiff[2] = $topDiff + $jgDiff + $midDiff - $adcDiff + $supDiff;
        $teamDiff[3] = $topDiff + $jgDiff + $midDiff - $adcDiff - $supDiff;
        $teamDiff[4] = $topDiff + $jgDiff - $midDiff + $adcDiff + $supDiff;
        $teamDiff[5] = $topDiff + $jgDiff - $midDiff + $adcDiff - $supDiff;
        $teamDiff[6] = $topDiff + $jgDiff - $midDiff - $adcDiff + $supDiff;
        $teamDiff[7] = $topDiff + $jgDiff - $midDiff - $adcDiff - $supDiff;
        $teamDiff[8] = $topDiff - $jgDiff + $midDiff + $adcDiff + $supDiff;
        $teamDiff[9] = $topDiff - $jgDiff + $midDiff + $adcDiff - $supDiff;
        $teamDiff[10] = $topDiff - $jgDiff + $midDiff - $adcDiff + $supDiff;
        $teamDiff[11] = $topDiff - $jgDiff + $midDiff - $adcDiff - $supDiff;
        $teamDiff[12] = $topDiff - $jgDiff - $midDiff + $adcDiff + $supDiff;
        $teamDiff[13] = $topDiff - $jgDiff - $midDiff + $adcDiff - $supDiff;
        $teamDiff[14] = $topDiff - $jgDiff - $midDiff - $adcDiff + $supDiff;
        $teamDiff[15] = $topDiff - $jgDiff - $midDiff - $adcDiff - $supDiff;


        for ($i = 0; $i < count($teamDiff); $i++) {
            $absteamDiff[$i] = abs($teamDiff[$i]);
        }

//print_r($absteamDiff);
//echo min($absteamDiff);
//echo "</br>";
        $min = min($absteamDiff);
        $minDiff = array_keys($absteamDiff, $min);
        $key = array_rand($minDiff, 1);
//echo $minDiff[$key];
//echo "</br>";
//echo $absteamDiff[$minDiff[$key]];


        if ($minDiff[$key] % 2 == 1) {
            $supDiff *= -1;
            $suptmp = $supBname;
            $supBname = $supAname;
            $supAname = $suptmp;
        }

        if ($minDiff[$key] % 4 == 2 || $minDiff[$key] % 4 == 3) {
            $adcDiff *= -1;
            $adctmp = $adcBname;
            $adcBname = $adcAname;
            $adcAname = $adctmp;
        }

        if ($minDiff[$key] % 8 == 4 || $minDiff[$key] % 8 == 5 || $minDiff[$key] % 8 == 6 || $minDiff[$key] % 8 == 7) {
            $midDiff *= -1;
            $midtmp = $midBname;
            $midBname = $midAname;
            $midAname = $midtmp;
        }

        if ($minDiff[$key] >= 8) {
            $jgDiff *= -1;
            $jgtmp = $jgBname;
            $jgBname = $jgAname;
            $jgAname = $jgtmp;
        }

        /*
          echo $topAname.$jgAname.$midAname.$adcAname.$supAname;
          echo "</br>";
          echo $topBname.$jgBname.$midBname.$adcBname.$supBname;
          echo "</br>";
          echo $teamDiff[$minDiff[$key]];
          echo "</br>";
          echo $topDiff ."/".$jgDiff."/".$midDiff."/".$adcDiff."/".$supDiff;
         */

        echo "<thead>";
        echo "<tr>
   <th>Aチーム</th>
   <th>ロール</th>
   <th>Bチーム</th>
   <th>A-B</th>
   </tr>";
        echo "<tr><td>", $topAname, "</td><td>", "TOP</td><td>", $topBname, "</td><td>", $topDiff, "</tr>";
        echo "<tr><td>", $jgAname, "</td><td>", "JG</td><td>", $jgBname, "</td><td>", $jgDiff, "</tr>";
        echo "<tr><td>", $midAname, "</td><td>", "MID</td><td>", $midBname, "</td><td>", $midDiff, "</tr>";
        echo "<tr><td>", $adcAname, "</td><td>", "ADC</td><td>", $adcBname, "</td><td>", $adcDiff, "</tr>";
        echo "<tr><td>", $supAname, "</td><td>", "SUP</td><td>", $supBname, "</td><td>", $supDiff, "</tr>";
        echo "<tr><td>", "</td><td>", "合計</td><td>", "</td><td>", $teamDiff[$minDiff[$key]], "</tr>";
    } else {
        echo "10人指定してください。";
    }
    ?>

</table>

<a>更新(F5)で再度シャッフルされます</a>