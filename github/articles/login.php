
 <h2>ログイン</h2>
    <p>

        <?php if(!empty($_GET["error"])){echo "ログインできませんでした。\nもう一度やり直してください。";} ?>
    </p>
    <script>
        function checkinput(){
            var mailaddress = document.getElementById("mailaddress");
            var password = document.getElementById("password");
            var submit = document.getElementById("submit");
            var test = document.getElementById("test");
            test.innerText="";
            if(mailaddress.value.length==0){
                test.innerText+="\nメールアドレスは1文字以上である必要があります";
            }
            if(password.value.length<4){
                test.innerText+="\nパスワードは4文字以上である必要があります";
            }
            if(test.innerText.length>0){
                submit.disabled=true;
            }else{
                submit.disabled=false;
            }


        }
    </script>
    <form action="../login/login_after.php" method="post">
        <input type="text" name="mailaddress" placeholder="メールアドレス" id="mailaddress" oninput="checkinput()"><br>
        <input type="password" name="password" placeholder="パスワード" id="password" oninput="checkinput()"><br>
        <input type="submit" name="submit" value="送信" id="submit" disabled="true">
        <p id="test" style="color: red"></p>
    </form>