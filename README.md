# lol_custom_teamcreationtool
身内でカスタムする際に使うことを想定したロールまで決定するチーム分けツールです。

# 使い方
member.jsonにメンバーの名前、レートを書き込んでからmaketeamform.phpを開いてください。  
10人選ぶと、チームとロールが決定されます。A-Bの値を見て適宜手調整をして使ってください。

## member.json
member.jsonには以下のようにデータが入っております。
```json:member
    "sasuke":[0,0,0,0,0,0]
    //"名前":[TOP補正値,JG補正値,MID補正値,ADC補正値,SUP補正値,基本値]
```
ロールを決めた際に基本値に補正値を足すことでロール別の戦力差を少なくしようとしています。
jsonを直接編集するかlist.editから編集できます。

## いろいろ
サークル内でカスタムゲームをする際に同じロールに行くことが多くなってしまう傾向にあったので　　
打破するために作成しました。
始めにランダムにロールを決めてからチームの強さを調整しているため完璧な調整はできません。
いい方法がありましたらご教授ください。
