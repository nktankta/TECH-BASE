<h2>CNN(Convolution Neural Network)</h2>
CNNとは、日本語では畳み込みニューラルネットワークと呼ばれ、画像を畳み込むことで性能を向上させた手法です。
畳み込みは入力画像と小さい画像の２つの画像で処理が行われているのですが、
<p><img src="../imgs/CNN_2.png" width="500" height="500"></p>
まず、この図のように入力画像の左上から小さい画像と同じサイズを取り出して要素ごとに掛け算を行い、合計を出します。
そして入力画像から取り出す位置を少しずつずらして再度計算します。その結果今回は3x3の値が出力がされます。
<table border="1" style="border-collapse: collapse;text-align: center" width="100" height="100">
    <tr>
        <td>2</td>
        <td>2</td>
        <td>1</td>
    </tr>
    <tr>
        <td>2</td>
        <td>1</td>
        <td>1</td>
    </tr>
    <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
    </tr>
</table>
上の表は演算結果です。
出力自体は１を超えてしまいますが特に問題はありません。
この演算を何度も繰り返すことで画像全体を見ることができ、AIの性能が著しく向上しました。
本来は活性化層やプーリング層などを挟み実行されますが、CNNの一番大切な部分はこの畳み込みにより画像を2次元的にとらえられるという点です。
現在画像に関するネットワークではCNNがほぼ必ず用いられており、物体認識や画像から文字への変換にも用いられています。
さらには音声などの時系列データに関しても用いるケースがあります。

