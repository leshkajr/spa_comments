let inputIdMain = document.getElementById('inputIdMain');
let inputIsMain = document.getElementById('inputIsMain');
let inputIdPreviewComment = document.getElementById('inputIdPreviewComment');

let container = document.getElementById('container-show-review-comment');
function clickReview(id, username, comment){
console.log('clickReview');
    let idMainComment = document.getElementById('idMainComment' + id);
    let idMainCommentValue = parseInt(idMainComment.value);
    if(idMainCommentValue === -1){
        inputIdMain.value = id;
    }
    else{
        inputIdMain.value = idMainCommentValue;
    }
    inputIdPreviewComment.value = id;
    inputIsMain.value = false;

    let container = document.getElementById('container-show-review-comment');
    let reviewUsername = document.getElementById('review-comment-username');
    let reviewComment = document.getElementById('review-comment-comment');
    container.style.display = 'block';

    reviewUsername.innerHTML = username;
    if(comment.length >= 50) {
        reviewComment.innerHTML = comment.substring(0,50) + '...';
    }
    else{
        reviewComment.innerHTML = comment;
    }

}
function deleteReview(){
    inputIdMain.value = null;
    inputIsMain.value = false;

    container.style.display = 'none';
}
