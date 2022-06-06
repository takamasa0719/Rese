function inputDate(){
    const input = document.getElementById("date");
    const str = input.value;
    document.getElementById('dateOut').textContent = str;
}

function inputTime(){
    const input = document.getElementById("time");
    const str = input.value;
    document.getElementById('timeOut').textContent = str;
}

function inputNumber(){
    const input = document.getElementById("number");
    const str = input.value + '人';
    document.getElementById('numberOut').textContent = str;
}
