var commentDiv = document.getElementById('comment');
var tmp = document.getElementById('homepage');

var savedRange;

function saveCursorPosition() {
    var selection = window.getSelection();
    if (selection.rangeCount > 0) {
        savedRange = selection.getRangeAt(0).cloneRange();
    }
}

function restoreCursorPosition() {
    if (savedRange) {
        var selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(savedRange);
    }
}

commentDiv.addEventListener('input', function () {
    saveCursorPosition();

    var editableDiv = commentDiv;
    var text = editableDiv.innerHTML;

    text = text.replace(/<span class="highlight">/g, '');
    text = text.replace(/<\/span>/g, '');

    text = text.replace(/&lt;a&gt;/g, '<span class="highlight">&lt;a&gt;</span><span class="highlight">');
    text = text.replace(/&lt;\/a&gt;/g, '</span><span class="highlight">&lt;/a&gt;</span>');

    text = text.replace(/&lt;code&gt;/g, '<span class="highlight">&lt;code&gt;</span><span class="highlight">');
    text = text.replace(/&lt;\/code&gt;/g, '</span><span class="highlight">&lt;/code&gt;</span>');

    text = text.replace(/&lt;i&gt;/g, '<span class="highlight">&lt;i&gt;</span><span class="highlight">');
    text = text.replace(/&lt;\/i&gt;/g, '</span><span class="highlight">&lt;/i&gt;</span>');

    text = text.replace(/&lt;strong&gt;/g, '<span class="highlight">&lt;strong&gt;</span><span class="highlight">');
    text = text.replace(/&lt;\/strong&gt;/g, '</span><span class="highlight">&lt;/strong&gt;</span>');

    editableDiv.innerHTML = text;

    restoreCursorPosition();

    try {
        var result = eval(text);

        // Отобразить результат
        document.getElementById('evalResult').innerText = 'Результат:\n' + result;
    } catch (error) {
        // В случае ошибки отобразить сообщение об ошибке
        document.getElementById('evalResult').innerText = 'Ошибка:\n' + error.message;
    }
});


function addTag(tag){

}
