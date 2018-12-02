var selectedWord = "";
var selectedHint = "";
var board = []; // empty array
var remainingGuesses = 6;
var alreadyDisplayedHint = false;
var subArr = [];
var getValues = sessionStorage.getItem("guessed");
var words = [{ word: "snake", hint: "It's a reptile" }, 
             { word: "monkey", hint: "It's a mammal" }, 
             { word: "beetle", hint: "It's an insect" }];


var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

window.onload = startGame();

$( document ).ready(function() {
    
$("#letters").on("click", ".letter", function(){
    checkLetter($(this).attr("id"));
    disableButton($(this));
});

$("#hintButton").on("click", function(){
     $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
     remainingGuesses--;
     updateMan();
     alreadyDisplayedHint = true;
     disableButton($(this));
});

$(".replayBtn").on("click", function() {
    location.reload();
});
    




});




function startGame() {
    pickWord();
    createLetters();
    initBoard();
    updateBoard();
}

function pickWord() {
    let randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function createLetters() {
    for (var letter of alphabet) {
        let letterInput = '"' + letter + '"';
        $("#letters").append("<button class='btn btn-success letter' id='" + letter + "'>" + letter + "</button>");
    }
}

function initBoard() {
    for (var letter in selectedWord) {
        board.push("_");
    }
    
}

function updateBoard() 
{
    $("#word").empty();
    for (var i=0; i < board.length; i++) 
    {
        $("#word").append(board[i] + " ");
    }
    $("#word").append("<br />");
    if(alreadyDisplayedHint)
    {
        $("#word").append("<button class='btn btn-success letter' id='hintButton'>Hint</button>");
        $("#word").append("<span class='hint'>" + selectedHint + "</span>");
        disableButton($("#hintButton"));
    }
    else
    {
        $("#word").append("<button class='btn btn-success letter' id='hintButton'>Hint</button>");

    }
    }

function updateWord(positions, letter)
{
    for (var pos of positions) {
        board[pos] = letter;
    }
    updateBoard(board);
    if (!board.includes('_')) {
        endGame(true);
    }
}


function checkLetter(letter) {
    var positions = new Array();
    for (var i = 0; i < selectedWord.length; i++) 
    {
        if (letter == selectedWord[i]) 
        {
            positions.push(i);
        }
    }
    if (positions.length > 0) {
        updateWord(positions, letter);
    } else {
        remainingGuesses -= 1;
        updateMan();
        
        if (remainingGuesses <= 0) {
            endGame(false);
        }
    }
}



function updateMan() {
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}


function endGame(win) {
    $("#letters").hide();
    
    if (win) {
        $('#won').show();
        subArr.push(selectedWord);
        $("#guessedWord").append("<li>"+selectedWord+"</li>")
       
        sessionStorage.setItem('guessed', subArr);
    } else {
        $('#lost').show();
        subArr.push(selectedWord);
        $("#guessedWord").append("<li>"+selectedWord+"</li>")
         sessionStorage.setItem('guessed', selectedWord);
          sessionStorage.setItem('guessed', subArr);
         $('#hintButton').hide();
    }
}

function disableButton(btn) {
    btn.prop("disabled",true);
    btn.attr("class", "btn btn-danger")
}


 