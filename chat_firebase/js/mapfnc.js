let map;
function mapsInit(position) {
    //lat=緯度、lon=経度 を取得
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    $("#text").html( lat + "・" + lon );
};

//2． 位置情報の取得に失敗した場合の処理
function mapsError(error) {
  let e = "";
  if (error.code == 1) { //1＝位置情報取得が許可されてない（ブラウザの設定）
    e = "位置情報が許可されてません";
  }
  if (error.code == 2) { //2＝現在地を特定できない
    e = "現在位置を特定できません";
  }
  if (error.code == 3) { //3＝位置情報を取得する前にタイムアウトになった場合
    e = "位置情報を取得する前にタイムアウトになりました";
  }
  alert("エラー：" + e);
};

//3.位置情報取得オプション
var set ={
    enableHighAccuracy: true, //より高精度な位置を求める
    maximumAge: 20000,        //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
    timeout: 15000            //10秒以内に現在地情報を取得できなければ、処理を終了
  };

  //getmapの取得イベント
$("#getmap").on("click",function(){
    navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);　　
  });
