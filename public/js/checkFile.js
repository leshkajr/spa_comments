function uploadFile() {
    var fileInput = document.getElementById('attachmentFiles');
    var file = fileInput.files[0];
    var previewDiv = document.getElementById('imagePreview');
    previewDiv.innerHTML = '';

    if (file) {
        var fileType = file.type;
        if (fileType !== 'image/jpeg' && fileType !== 'image/png' && fileType !== 'image/gif' && fileType !== 'text/plain') {
            alert('Acceptable file formats: JPG, PNG, GIF, TXT');
            fileInput.value = '';
            return;
        }

        if (fileType.startsWith('image/')) {
            var img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function () {
                if (img.width > 320 || img.height > 240) {
                    var aspectRatio = img.width / img.height;
                    var newWidth = Math.min(img.width, 320);
                    var newHeight = newWidth / aspectRatio;

                    var canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    var resizedImage = canvas.toDataURL(fileType);
                    console.log(resizedImage);
                    previewImage('imagePreview',resizedImage);
                } else {
                    console.log('Original Image:', img.src);
                    previewImage('imagePreview',img.src);
                }
            };
        }

        if (fileType === 'text/plain') {
            if (file.size > 100 * 1024) {
                alert('The text file should not be more than 100 kb');
                return;
            }

            // Отправка текстового файла на сервер...
            console.log('Text File:', file);
        }
    } else {
        alert('Select the file to download.');
    }
}


function previewImage(divContainer,src) {
    var previewDiv = document.getElementById(divContainer);
    previewDiv.innerHTML = '';

    var linkPreviewImage = document.createElement('a');
    linkPreviewImage.href = src;
    linkPreviewImage.setAttribute("data-fancybox","gallery");

    var previewImage = document.createElement('img');
    previewImage.src = src;
    previewImage.style.maxWidth = '220px';
    previewImage.style.maxHeight = '160px';

    linkPreviewImage.appendChild(previewImage);
    previewDiv.appendChild(linkPreviewImage);
}
$(document).ready(function () {
    $("[data-fancybox]").fancybox({
        // Настройки FancyBox
        // Пример: transitionEffect: "slide"
    });
});
