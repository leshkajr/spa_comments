function uploadFile() {
    var fileInput = document.getElementById('attachmentFiles');
    var file = fileInput.files[0];

    if (file) {
        // Проверка типа файла
        var fileType = file.type;
        if (fileType !== 'image/jpeg' && fileType !== 'image/png' && fileType !== 'image/gif' && fileType !== 'text/plain') {
            alert('Допустимые форматы файлов: JPG, PNG, GIF, TXT');
            fileInput.value = '';
            return;
        }

        if (fileType.startsWith('image/')) {
            // Создаем изображение для проверки размеров
            var img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function () {
                // Проверка размеров изображения
                if (img.width > 320 || img.height > 240) {
                    // Пропорциональное уменьшение изображения
                    var aspectRatio = img.width / img.height;
                    var newWidth = Math.min(img.width, 320);
                    var newHeight = newWidth / aspectRatio;

                    var canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    // Получаем уменьшенное изображение в формате base64
                    var resizedImage = canvas.toDataURL(fileType);
                    console.log(resizedImage);
                    previewImage(resizedImage);
                    // Отправка уменьшенного изображения на сервер...
                } else {
                    // Отправка оригинального изображения на сервер...
                    console.log('Original Image:', img.src);
                    previewImage(img.src);
                }
            };
        }

        if (fileType === 'text/plain') {
            // Проверка размера текстового файла
            if (file.size > 100 * 1024) {
                alert('Текстовый файл не должен быть больше 100 кб');
                return;
            }

            // Отправка текстового файла на сервер...
            console.log('Text File:', file);
        }
    } else {
        alert('Выберите файл для загрузки.');
    }
}


function previewImage(src) {
    var previewDiv = document.getElementById('imagePreview');
    previewDiv.innerHTML = '';

    var previewImage = document.createElement('img');
    previewImage.src = src;
    previewImage.style.maxWidth = '220px';
    previewImage.style.maxHeight = '160px';
    previewDiv.appendChild(previewImage);
}
