let isLiked = false;
let isDisliked = false;
let likeCount = 0;
let dislikeCount = 0;

function like() {
    if (isLiked) {
        isLiked = false;
        likeCount--;
    } else {
        if (isDisliked) {
            isDisliked = false;
            dislikeCount--;
        }
        isLiked = true;
        likeCount++;
    }
    updateButtons();
}

function dislike() {
    if (isDisliked) {
        isDisliked = false;
        dislikeCount--;
    } else {
        if (isLiked) {
            isLiked = false;
            likeCount--;
        }
        isDisliked = true;
        dislikeCount++;
    }
    updateButtons();
}

function updateButtons() {
    const likeBtn = document.getElementById("like-btn");
    const dislikeBtn = document.getElementById("dislike-btn");

    likeBtn.innerHTML = `<i class="fas fa-solid fa-thumbs-up"></i>: ${likeCount}`;
    dislikeBtn.innerHTML = `<i class="fas fa-solid fa-thumbs-down"></i>: ${dislikeCount}`;
}