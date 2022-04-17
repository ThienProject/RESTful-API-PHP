const questionGroup = document.getElementsByClassName('content')[0];
const point = document.getElementsByClassName('point')[0];
const btnNext = document.querySelector('.btn-next');
const btnRestart = document.querySelector('.btn-restart');
const questionAPI = 'http://localhost/RESTful-API-PHP/api/question/read.php';
let currentQuestion = 0;
let arrLength = 0;
let dataArr = [];
let total = 0;
 let answerSelect  = '';
fetch(questionAPI)
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        arrLength =  data.length;
        dataArr = data;
        render(data[0]);
    })
    .catch(function (err) {
        console.log(err);
    });

function render(question) {
    let answerTrue = question.ansTrue;
        answerSelect  = ''
    html1 = `<h2 class="content-question">${question.content}</h2> </h2>
            <ul class="list-answer">` 

    const arr = Object.entries(question);
    
   // console.log(arr);
    html2 = '';
    for(var i = 2; i < arr.length-1; i++){
            
            html2 += `<li class="answer-item">
                            <input type="radio" name="answer" id="${arr[i][0]}">
                            <label for="ansA">${arr[i][1]}</label>
                      </li>
            `
    };
    html3 = ` </ul>`
    questionGroup.innerHTML = html1+html2+html3;

    /// set listen event for input
   
    const inputs = document.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.oninput = function(){
            answerSelect =  input.id;
            if(answerTrue === answerSelect){
                alert("Đúng rồi bạn được cộng 10 điểm !");
                total += 10;
            }
            else {
                alert("Sai rồi bạn bị trừ 10 điểm !");
                total -= 10;
            }
            point.innerText = total;
            btnNext.click();
        }
    })

}

// handle the next question
btnNext.onclick = function() { 
    if(answerSelect === ''){
        alert("Vui lòng chọn đáp án trước !");
    }
    else {
        currentQuestion ++;
        if((currentQuestion) > arrLength-1){
            
            btnNext.style.display = 'none';
            btnRestart.style.display = 'block';
            
        }
        else {
            render(dataArr[currentQuestion]);
        }
    }
    
    
}
btnRestart.onclick = function() {
    restartGame();
}

function restartGame(){
    currentQuestion = 0;
    render(dataArr[currentQuestion]);
    btnNext.style.display = "block";
    btnRestart.style.display = "none";
    total = 0;
    point.innerText = 0;
}


