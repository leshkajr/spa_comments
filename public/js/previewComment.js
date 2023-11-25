let previewButton = document.getElementById('preview-button');
let closePreviewButton = document.getElementById('close-preview-button');
let refreshPreviewButton = document.getElementById('refresh-preview-button');
let previewCommentContainer = document.getElementById('preview-comment-container');

function fillWithData(){

    let usernamePreview = document.getElementById('username-preview');
    let timestampPreview = document.getElementById('timestamp-preview');
    let commentPreview = document.getElementById('comment-preview');
    let imagePreviewPreview = document.getElementById('imagePreview-preview');


    let usernameInput = document.getElementById('username');
    let comment = document.getElementById('comment');
    if(!usernameInput.classList.contains('is-invalid') && !comment.classList.contains('is-invalid')){
        if(usernameInput.value.trim() !== '' && comment.value.trim() !== ''){
            usernamePreview.innerHTML = usernameInput.value;
            let date = new Date();
            timestampPreview.innerHTML = date.toLocaleString()
            commentPreview.innerHTML = comment.value;

            var fileInput = document.getElementById('attachmentFiles');
            var file = fileInput.files[0];
            if(file !== undefined){
                let src = URL.createObjectURL(file)
                previewImage(imagePreviewPreview.id,src);
            }

            previewButton.style.display = 'none';
            closePreviewButton.style.display = 'block';
            previewCommentContainer.style.display = 'block';
            refreshPreviewButton.style.display = 'block';
        }
        else{
            alert('Please enter data to preview');
        }
    }
    else{
        alert('Please clear errors');
    }
}

previewButton.addEventListener('click', function (){
    fillWithData();
});
closePreviewButton.addEventListener('click', function (){
    previewButton.style.display = 'block';
    closePreviewButton.style.display = 'none';
    previewCommentContainer.style.display = 'none';
    refreshPreviewButton.style.display = 'none';
});
refreshPreviewButton.addEventListener('click', function(){
    fillWithData();
});
