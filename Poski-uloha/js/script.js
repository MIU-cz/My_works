// Počet příspěvků - test-1
function countMessages() {
    var messages = document.getElementsByTagName("p").length;
    console.log("Počet příspěvků: " + messages);
}


// Průměrná výška příspěvků - test-2
function calcAverage() {
    var input = document.getElementById("input").value;
    var values = input.split(",");
    var sum = 0;
    for (var i = 0; i < values.length; i++) {
        sum += parseInt(values[i]);
    }
    var average = sum / values.length;
    console.log("Průměrná výška příspěvků: " + average);
}


// Součet délek nadpisů příspěvků - test-3
function sumHeaderLengths(messages) {
    let sum = 0;
    for (let i = 0; i < messages.length; i++) {
        sum += messages[i].title.length;
    }
    return sum;
}
console.log(sumHeaderLengths(messages));


// Při kliknutí na příspěvek do objektu vypsat: název, datum, délku - test-4

function addTab() {
    const name = prompt("Napiste nazev:");
    const date = prompt("Napiste datum:");
    const length = prompt("Napiste delku:");

    const result = document.getElementById("testDiv");
    result.innerHTML = `Nazev: ${name}<br>Datum: ${date}<br>Delka: ${length}`;
}


// Při scrollu vrátit pozici sociálních ikon vůči viewportu a dokumentu