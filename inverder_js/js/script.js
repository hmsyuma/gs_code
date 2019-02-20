
//canvasの宣言(JQ-ver-)
const can = $("#canvas")[0];
const ctx = can.getContext("2d");

//オブジェクトの定義
const ufo = {
posX:-40,
posY:can.height/2,
img:"images/ship.png"
};

//attr(name,value)で指定した属性にvalueの値を設定
//ufo.imgでufoオブジェクトの値を取得
//newImageはimgタグにsrcとufo.imgを格納する処理
const newImage = $('<img>').attr("src", ufo.img);

//.on("load")により、imgタグの埋め込み
newImage.on("load", function(){
    console.log(this);//this=newImageにより変数の格納を確認
    ctx.drawImage(this, ufo.posX, ufo.posY);
    ufo.width　= this.width; //ufoオブジェクトへimgのwidthを追加
    ufo.height = this.height;
    ufo.img = this;

    console.log(ufo);    
});

//-----------------------------ufoを動かす処理-----------------------------------
//引数として、マウス位置を渡す。
$(can).on("mousemove", function(e){
    ctx.clearRect(0, ufo.posY, ufo.width, ufo.height);
    console.log(e);//マウスのホバー位置を出力
    ufo.posY = e.offsetY - ufo.height ;
    ctx.drawImage(ufo.img, ufo.posX, ufo.posY, ufo.width, ufo.height);
});

    
/*---------------------------
* ufoが発射する弾について
*--------------------------*/

const ballDate = {
       speed:10,
       width:50,
       height:50,
       posX:ufo.width,
       posY:ufo.posY,
　　　  color:"#f00"
   }

   //発射された玉の配列を作成　データの上書き防止 発射された弾を個別に管理する。
   const ballGroup = [];
     
    /*---------------------------
     * ufoが発射する弾について
    *--------------------------*/
    const shootBall = function(e){
        const newShootBall = Object.assign({}, ballDate);　//もとのオブジェクトに影響を及ぼさず追加
        newShootBall.posX = ufo.width;
        newShootBall.posY = ufo.posY + (ufo.height/2);
        ctx.fillStyle = ballDate.color;
        ctx.fillRect(newShootBall.posX,newShootBall.posY,newShootBall.width,newShootBall.height);
        ballGroup.push(newShootBall);
        console.log(ballGroup);
    }

    $(can).on("mousedown",shootBall);
    const moveBall = function(){
        ballGroup.forEach(function(ball){
            ctx.clearRect(ball.posX, ball.posY, ball.width, ball.height);
            ball.posX += ball.speed;
            ctx.fillRect(ball.posX, ball.posY, ball.width, ball.height)
        });
    };


    const deleteBall = function(ball){
        for(let i=0; i<ballGroup.length; i++){
        if(ballGroup[i].posX >= can.width){
            ballGroup.splice(i,1);
            console.log(ballGroup)
        }
      }
    };
   
    // ------------------------ループ処理--------------------------
    setInterval(moveEnemy,50);
    setInterval(function(){
        moveBall();
        deleteBall();
    },50);



    /*---------------------------
     * 敵について 
     *--------------------------*/
    var frame = 0;              //実行回数        
    var ene_x = 700;			// 相手のx位置
    var ene_y = 300;			// 相手のx位置
    var ene_dx = 10;				//相手の移動方向
    var ene_color = "red";			// 相手のx位置

    //不本意なループ処理　色分けで敵を描画
    function moveEnemy(){
        ctx.fillStyle = "black";				//灰色で塗りつぶし
        ctx.fillRect(300,0,500,600);		//四角形で塗りつぶし


        ctx.fillStyle = ene_color;				//赤
        ctx.fillRect(ene_x-50,ene_y-10,100,20);		//塗りつぶし
        ctx.fillRect(ene_x-50,ene_y-50,100,20);		//塗りつぶし
        ctx.fillRect(ene_x-50,ene_y-30,20,60);		//塗りつぶし
        ctx.fillRect(ene_x-10,ene_y-30,20,20);		//塗りつぶし
        ctx.fillRect(ene_x+30,ene_y-30,20,60);		//塗りつぶし
        ctx.fillRect(ene_x-30,ene_y+30,20,20);		//塗りつぶし
        ctx.fillRect(ene_x+10,ene_y+30,20,20);		//塗りつぶし
        ctx.fillRect(ene_x-70,ene_y-30,20,20);		//塗りつぶし
        ctx.fillRect(ene_x-90,ene_y-10,20,20);		//塗りつぶし
        ctx.fillRect(ene_x+50,ene_y-30,20,20);		//塗りつぶし
        ctx.fillRect(ene_x+70,ene_y-10,20,20);		//塗りつぶし
        ctx.fillRect(ene_x-30,ene_y-70,20,20);		//塗りつぶし
        ctx.fillRect(ene_x+10,ene_y-70,20,20);		//塗りつぶし
        ene_color = "red";


        ene_y = ene_y + ene_dx;
        if(ene_y > 550)	ene_dx = -10;
        if(ene_y < 100)	ene_dx =  10;

    };
    
   

// --------------------------エラーで動かなかった画像のループ処理(上下位移動)------------------------------------------------
    // const enemy = {
    //     posX:can.width,
    //     posY:300,
    //     img:"images/stamp10.png",
    // 　　 width:100,
    //     height:100
    //     };


    // const subImage = $('<img>').attr("src", enemy.img);
    // subImage.on("load", function(){　　//on("load")newImageのタグを読み込む
    //     console.log(this);      　　　 //imagesタグが出力されている
    //     enemy.img = this;
    //     enemy.posX = can.width - enemy.width;
    //     ctx.drawImage(this, enemy.posX, enemy.posY);
    //   });

     
    //     subImage.on("load",function(){
    //     ctx.clearRect(enemy.posX, enemy.posY,enemy.width,enemy.height);//引数を4つ取る必要があるので、注意
        
    //     if(enemy.posY < 600){
    //         enemy.posY = enemy.posY - 100;
    //     }
    //     else if(enemy.posY >  50){ 
    //         enemy.posY = enemy.posY + 100;
    //     }

    //     console.log(enemy.posY)
    //       ctx.drawImage(enemy.img, enemy.posX, enemy.posY);
    //       alert("ok")
    //   })
    // --------------------------エラーで動かなかった画像のループ処理(上下位移動)------------------------------------------------    