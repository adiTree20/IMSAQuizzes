// ID: 124167
// Quarter 2 Project

// JavaScript Sheet Below

function siLoginCheck() {
    document.getElementById("siFound").innerHTML = "The email or password entered is incorrect.";
}

function suLoginFound() {
    document.getElementById("suFound").innerHTML = "The email entered is already used.";
}

function suLoginCheck() {
    document.getElementById("suFound").innerHTML = "The passwords entered are not identical.";
}

function suSuccess() {
    document.getElementById("suFound").style.color = "seagreen";
    document.getElementById("suFound").innerHTML = "Congratulations! You have successfully created an account!";
}

function newColor() {
    r = Math.floor(Math.random()*256);
    g = Math.floor(Math.random()*256);
    b = Math.floor(Math.random()*256);
    return "rgb("+r+","+g+","+b+")";
}

function nqCreateNewQuestion() {
    if (scriptCount <= 20) {
        value = scriptCount + 11;
        extraQuestion = "<span class='newQuizQuestion'>Question </span><span class='newQuizCircleNumbers'>&#93" + value + "; </span><br><textarea type='text' name='question" + scriptCount + "' class='newQuizInputQuestion' required></textarea><br><span class='newQuizQuestion'>Answer </span><span class='newQuizCircleNumbers'>&#93" + value + "; </span><br><textarea type='text' name='answer" + scriptCount + "' class='newQuizInputAnswer' required></textarea><br><br><hr><br>";
        
        document.getElementById("extraQuestions").innerHTML += extraQuestion;
    
        window.alert("Question Number " + scriptCount + " has been created!");
    
        scriptCount++;
    }
    else {
        window.alert("The max number of questions you can make is 20!");
    }
}