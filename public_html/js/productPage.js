var min = document.getElementById('button-addon1');
var max = document.getElementById('button-addon2');
var quant = document.getElementById('quant');

min.onclick = function() {
    if(parseInt(quant.value) > 0) {
        quant.value = parseInt(quant.value) - 1;
    }
}

max.onclick = function() {
    if(parseInt(quant.value) < 5) {
        quant.value = parseInt(quant.value) + 1;
    }
}