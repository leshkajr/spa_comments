var textarea = document.getElementById('comment');
var tmp = document.getElementById('homepage');

function getCursorPosition(el) {
    var pos = 0;

    if ('selectionStart' in el) {
        pos = el.selectionStart;
    } else if ('selection' in document) {
        el.focus();
        var Sel = document.selection.createRange();
        var SelLength = document.selection.createRange().text.length;
        Sel.moveStart('character', -el.value.length);
        pos = Sel.text.length - SelLength;
    }

    return pos;
}

function selectRange(el, start, end) {
    if (end === undefined) {
        end = start;
    }

    if ('selectionStart' in el) {
        el.selectionStart = start;
        el.selectionEnd = end;
    } else if (el.setSelectionRange) {
        el.setSelectionRange(start, end);
    } else if (el.createTextRange) {
        var range = el.createTextRange();
        range.collapse(true);
        range.moveEnd('character', end);
        range.moveStart('character', start);
        range.select();
    }
}
const forbiddenTags = ['div', 'input', 'select', 'textarea', 'button','pre','h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' ,'hr' , 'br'];
textarea.addEventListener('focus', function () {
    sessionStorage.cursorPosition = getCursorPosition(textarea);
});
textarea.addEventListener('input', function () {
    // let cursorPosition = getCursorPosition(textarea);
    // sessionStorage.cursorPosition = cursorPosition;

    let text = textarea.value;
    let checkResult = document.getElementById('checkResult');
    checkResult.innerText = '';

    let isError = false;
    forbiddenTags.forEach((element) => {
        let tag = '<' + element + '>';
        let tagClose = '</' + element + '>';
        if(text.includes(tag) || text.includes(tagClose)){
            checkResult.innerText += tag + ' is forbidden tag';
            checkResult.innerHTML += '<br>';
            isError = true;
        }
    });
    if(isError){
        textarea.classList.add('is-invalid');
    }

    let invisibleBlock = document.getElementById('invisibleBlock');
    invisibleBlock.innerHTML = text;
    let isError2 = false;
    for (let elementsByClassNameElement of invisibleBlock.querySelectorAll("*")) {
        console.log(elementsByClassNameElement.tagName);
        if(elementsByClassNameElement.tagName === 'A'){
            for (let attributes of elementsByClassNameElement.attributes){
                if(attributes.name === 'href' || attributes.name === 'title'){
                    isError2 = false
                }
                else{
                    isError2 = true
                }
            }
        }
    }
    if(isError2){
        checkResult.innerText += ' Allowed attributes for <a>: "href", "title"';
        checkResult.innerHTML += '<br>';
        textarea.classList.add('is-invalid');
    }

    if(isError === false && isError2 === false) {
        textarea.classList.remove('is-invalid');
    }
    // editableDiv.value = text;

    // selectRange(textarea, sessionStorage.cursorPosition);

});

function addTag(tag){
    let leftSideText = textarea.value.substring(0,getCursorPosition(textarea));
    let rightSideText = textarea.value.substring(getCursorPosition(textarea), textarea.value.length);
    let middleText;
    if(tag === 'a'){
        middleText = '<a></a>'
    }
    else if(tag === 'code'){
        middleText = '<code></code>'
    }
    else if(tag === 'i'){
        middleText = '<i></i>'
    }
    else if(tag === 'strong'){
        middleText = '<strong></strong>'
    }
    textarea.value =  leftSideText + middleText + rightSideText;
    textarea.focus();
}


