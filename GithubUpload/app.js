//creating html for game 
const gameArea = document.querySelector('.game');
const btn = document.createElement('button');  ////Object Button
const btn1 = document.createElement('button'); //// Object Button1
const output = document.createElement('div');
const answer = document.createElement('input');
const message = document.createElement('div');
const table = document.querySelector('table');
const tbody = table.querySelector('tbody');
output.textContent = "Click the button to start the game";
btn.textContent = "Start Game";
btn1.textContent = "Next Question";
answer.setAttribute('type','number');
answer.setAttribute('max',999);
answer.setAttribute('min',0);
output.classList.add('output');
message.classList.add('message');
answer.classList.add('boxAnswer');
gameArea.append(message);
gameArea.append(output);
gameArea.append(btn);
gameArea.append(btn1);
btn1.style.display = 'none';
 const opts = ['*','/','+','-'];
const game = {correct:'',maxValue:10,questions:10,oVals:[0,1,2,3],curQue:0,hiddenVal:3,inplay:false};
const player = {correct:0,incorrect:0};

// adding evernt liseners tt buttons  
btn.addEventListener('click',btnCheck);
btn1.addEventListener('click', buildQuestion);

answer.addEventListener('keyup',(e)=>{
    console.log(e.code);
    console.log(answer.value.length);
    if(answer.value.length > 0 ) {
        btn.style.display = 'block';
        btn.textContent = 'Check';
        game.inplay = true;
    }
    if(e.code == 'Enter'){
        game.inplay = true;
        btnCheck();
    }
})
 
 var isfirst =0;
 var iscompletewithinTime = 0;
function btnCheck(){
    $(".time").show();
        if(isfirst == 0){

            startTimer();
            isfirst = 1;
        }
    btn.style.display = 'none';
    if(game.inplay){
        if(answer.value == game.correct){
            message.innerHTML = 'Correct<br>Answer is '+game.correct;
            player.correct++;
        }else{
            message.innerHTML =  'Wrong<br>Answer is '+game.correct;
            player.incorrect++;
        }
        
        answer.disabled = true;
        nextQuestion();
    }else{
        game.curQue = 0;
        buildQuestion();
    }
}

function nextQuestion(){
    btn1.style.display = 'block';
}

function scoreBoard(){
    message.innerHTML = `${game.curQue} of ${game.questions} Questions<br>`;
    message.innerHTML += `Correct : (${player.correct}) vs (${player.incorrect})`;
} 
function buildQuestion(){
    console.log(game.curQue + ' of '+ game.questions);

    if(game.curQue < game.questions){
        game.curQue++;
        scoreBoard();
        output.innerHTML='';
        let vals = [];
        vals[0] = Math.ceil(Math.random()*(game.maxValue));
        let tempMax = game.maxValue+1;
        game.oVals.sort(()=>{return 0.5 - Math.random()});
        if(game.oVals[0] == 3){
            tempMax = vals[0];
        }
        vals[1] = Math.floor(Math.random()*tempMax );
        game.oVals.sort(()=>{return 0.5 - Math.random()});
        if(game.oVals[0] == 0){
            if(vals[1]==0){vals[1]=1;}
            if(vals[0]==0){vals[0]=1;}
        }
        if(game.oVals[0] == 1){
            if(vals[0] ==0){vals[0]=1;}
            let temp = vals[0] * vals[1];
            vals.unshift(temp);  
        }else{
            vals[2] = eval(vals[0] + opts[game.oVals[0]] + vals[1]);
        }
        vals[3] = opts[game.oVals[0]];
        let hiddenVal;
        if(game.hiddenVal != 3){
            hiddenVal = game.hiddenVal;
        }else{
            hiddenVal = Math.floor(Math.random()*3);
        }
        answer.value = '';
        answer.disabled = false;
        for(let i=0;i<3;i++){
            if(hiddenVal == i){
                game.correct = vals[i];
                output.append(answer);
            }else{
                maker(vals[i],'box');
            }
            if(i==0){
                console.log(vals[3]);
                let tempSign = vals[3] == '*' ? '&times;' : vals[3];
                maker(tempSign,'boxSign');
            }
            if(i==1){
                maker('=','boxSign');
            }
        }
        answer.focus();
        //vals[hiddenVal] = '__';
        //output.innerHTML = `${} ${vals[3]} ${vals[1]} = ${vals[2]} `;
    }
    else{
        message.innerHTML = `Game Over<br>`;
    message.innerHTML += `Correct : (${player.correct}) vs (${player.incorrect})`;
      $(".output").hide();
      $(".time").hide();
      $(".game button").hide();
      iscompletewithinTime = 1;
      saveReusult();
    }
 
}
 
function maker(v,cla){
    const temp = document.createElement('div');
    temp.classList.add(cla);
    temp.innerHTML = v;
    output.append(temp);
}




function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if((m + '').length == 1){
    m = '0' + m;
  }
  if(m < 0){
    m = '59';
  }
  document.getElementById('timer').innerHTML = m + ":" + s;
    if(s == 0 && m == 0 && iscompletewithinTime == 0){
        message.innerHTML = `Game Over<br>`;
    message.innerHTML += `Correct : (${player.correct}) vs (${player.incorrect})`;
      $(".output").hide();
      $(".time").hide();
      $(".game button").hide();
      scoreBoard();
      saveReusult();
    }
    else{
  setTimeout(startTimer, 1000);
}
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; 
  if (sec < 0) {sec = "59"};
  return sec;
}










function saveReusult(){
    // saving result to database througt ajax call
       $.ajax({
        url: "saveresult.php",
        type: "post",
        data: {id:u_id.value,avatar: $("input[name='avatar']:checked").val(),score:player.correct},
        
    }).done(function (response) {
                result = JSON.parse(response);
                console.log(result);
                tabllehtml = '';
                for(i=0; i<result.length; i++){
             //when ajax request is done showing data at the fornt          
tbody.insertAdjacentHTML('beforeend', `   <tr class="row">
      <td class="name">${result[i].name}</td>
      <td class="double"><img src="avatar/${result[i].avatar}"/></td>
      <td class="points">${result[i].score}</td>
    </tr>`)
}

$("#scoreboard").show();
})
}
$(document).ready(function(){
    //  changing timer accroding to sleected level
    $("#leves button").click(function(){
        $("#leves button").removeClass("slected");
        $(this).addClass("slected");
        timer.innerText = $(this).attr('data-time')
    })


$("#netbt button").click(function(){
     // making  sure avatar and level is slected
  if( $("input[name='avatar']:checked").val() != undefined && $("#leves button").hasClass("slected")){
    $(".game").show();
    $("#avatars").hide();
    $("#leves").hide();
    $(this).parent().hide();
  }
  // if avatar not slected
  else if($("input[name='avatar']:checked").val() == undefined ){
    alert("please select avatar");
  }
// if level not slected 
   else if(! $("#leves button").hasClass("slected") ){
    alert("please select Level");
  }

  
})
});