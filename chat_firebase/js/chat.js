
// <!--** 以下Firebase **-->

  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDkfz71ko3H6g3WSNIoXPAr-gg9xK3NJrI",
    authDomain: "dev12-e63e5.firebaseapp.com",
    databaseURL: "https://dev12-e63e5.firebaseio.com",
    projectId: "dev12-e63e5",
    storageBucket: "dev12-e63e5.appspot.com",
    messagingSenderId: "706635187858"
  };
  firebase.initializeApp(config);
　
  //msg送受信準備
　var newPostRef = firebase.database().ref();
 

 //メッセージpushの定義　データ送信の定義
 //送信オブジェクト.push({送信プロパティ名:値})
function megPush(){
      // メッセージ画が空の場合は処理が止まる処理 
      let username=  $("#username").val();
      let text = $("#text").val();
      if(username==""){ 
        alert("ユーザー名が記載されておりません");
        exit;} 　
        //exitをreturnで記述できないのか
    
       if(text=="送信メッセージが入力されておりません。"){ 
        alert("空");
        exit;};
      // メッセージ画が空の場合は処理が止まる処理 
      newPostRef.push({
      username : $("#username").val(),
      text : $("#text").val()
    });
　　 $("#text").val("")
}
 

//senボタン送信用イベント
$("#send").on("click",function(){
    megPush();   
    $('#output').animate({scrollTop: $('#output')[0].scrollHeight}, 'fast');
});
　
//Enterで送信
$("#text").on("keydown",function(e){
  if(e.keyCode==13){
    megPush();
  }
//    console.log(e);
});

// mapの送信イベント
$('#Mymap').on("click",function(){
  $("#text").html("file:///Users/shimohozuma/Desktop/04%E5%9B%9E%E7%9B%AE%E3%80%80%E8%AC%9B%E7%BE%A9%E8%B3%87%E6%96%99%E3%80%80Cat/js03/geolocation_string.html");
  // megPush();   
  // $('#output').animate({scrollTop: $('#output')[0].scrollHeight}, 'fast');
});


//データの受信
newPostRef.on("child_added",function(date){
    let v = date.val(); //データの取得
    let k = date.key; //今日は使わない
    console.log(v);

    let str = '<p>'+v.username+'<br>'+v.text+'</p>';
    $("#output").append(str);
});


