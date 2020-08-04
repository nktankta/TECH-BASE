<h2>DML(Deep Metric Learning)</h2>
<h3>はじめに</h3>
DMLは日本語では深層距離学習と呼ばれています。
画像を2枚入力して、それがもし同じクラスなら距離が近くに、違うクラスなら遠くにいくように学習するネットワークネットワークです。
今回は犬か猫かという分類をするときを考えます。
<p><img src="../imgs/DML_1.png" width="620" height="400"></p>
画像のように犬同士であれば出力される距離が近く、犬と猫であれば遠くになるように学習させます。
実際のネットワークでは、
<p><img src="../imgs/DML_3.png" width="620" height="400"></p>
このように、ネットワークの出力するベクトル間の距離で画像間の距離を測ります。
この学習方法により、同じクラスの画像同士を近くに、異なるクラスの画像を遠くに配置するので、
事前に画像をベクトルに変換しておけば似ている画像も検索できる。
また、クラス分類の手法と異なり未知のクラスであっても距離が近くなり、学習データに存在しないデータも分類できます。
そのため未知のデータでの分類が多い顔認識などの生体認証に用いられている。