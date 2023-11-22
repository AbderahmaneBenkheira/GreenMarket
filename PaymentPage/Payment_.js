

document.querySelector('.cardNum-Input').oninput = function () {
    document.querySelector('.cardnum-info').innerText = document.querySelector('.cardNum-Input').value;
}
document.querySelector('.cardHolder-Input').oninput = function () {
    document.querySelector('.card-holder-name').innerText = document.querySelector('.cardHolder-Input').value;
}
document.querySelector('.month-input').oninput = function () {
    document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
}
document.querySelector('.year-input').oninput = function () {
    document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
}
document.querySelector('.cvv').onmouseenter = function () {
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
}
document.querySelector('.cvv').onmouseleave = function () {
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
}
document.querySelector('.cvv').oninput = function () {
    document.querySelector('.cvv-box').innerText = document.querySelector('.cvv').value;
}


//add the space between each 4 numbers

var cardNumInput = document.querySelector('.cardNum-Input');

cardNumInput.addEventListener('input', function () {
    // update the card number info
    var formattedCardNumber = AddLines(cardNumInput.value);
    document.querySelector('.cardnum-info').innerText = formattedCardNumber;
});


function AddLines(CN) {

    var formattedCardNumber = '';
    for (var i = 0; i < CN.length; i++) {

        if (i % 4 === 0 && i > 0) {
            formattedCardNumber += ' ';
        }
        formattedCardNumber += CN[i];
    }

    return formattedCardNumber;
}