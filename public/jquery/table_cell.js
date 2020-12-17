//FRONTEND VALIDATION FOR CONTENTEDITABLE
$(document).ready(function () {
    $('[contenteditable="true"]').keypress(function(event) {
        let x = event.charCode || event.keyCode;
        if (isNaN(String.fromCharCode(event.which)) && x!=46 || x===32 || x===13 ||
            (x===46 && event.currentTarget.innerText.includes('.'))) event.preventDefault();
    });
});
