const mainId = document.querySelector('main').id;
mainId === 'main' ? main() :
mainId === 'detailPost' ? detailPost() :
mainId === 'profile' ? profile() :
mainId === 'postStatistics' ? postStatistics() :
mainId;

function detailPost() {
    const form = document.querySelector('form');
    const comments = [...document.querySelectorAll('.comment')];
    const handleCommentInputBlur = e => {
        e.currentTarget.value = '';
    }
    const handleInputBlur = e => {
        const comment = e.currentTarget.parentNode;
        const commentValue = comment.querySelector('div').innerText;
        comment.innerHTML = `<div>${commentValue}</div>`;
    }
    const handleInputKeydown = e => {
        e.key === 'Enter' && e.currentTarget.value.trim() ?
        form.submit() : false;
    }
    const handelCommentClick = ({currentTarget}) => {
        const form = currentTarget.parentNode.parentNode;
        if(form.nestedCommentInput) return;
        const input = document.createElement('input');
        const hiddenInput = document.createElement('input');
        input.type = 'text';
        input.name = 'nestedCommentInput';
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'cidx';
        hiddenInput.value = currentTarget.dataset.cidx;
        currentTarget.appendChild(input);
        currentTarget.appendChild(hiddenInput);
        input.focus();
        input.addEventListener('blur', handleInputBlur);
        input.addEventListener('keydown', handleInputKeydown);
    }
    const handleFormSubmit = e => {
        e.preventDefault();
        if(e.currentTarget.commentInput.value.trim()) {
            e.currentTarget.submit();
            e.currentTarget.commentInput.value = '';
        }
    }
    comments.forEach(e => e.addEventListener('click', handelCommentClick));
    form.commentInput.addEventListener('blur', handleCommentInputBlur)
    form.addEventListener('submit', handleFormSubmit);
}

function postClick() {
    const posts = [...document.querySelectorAll(".post")];
    const handlePostClick = e => {
        const pidx = e.currentTarget.dataset.pidx;
        e.target.classList.contains('likeBtn') ?
        location.href = `/liked/${pidx}` :
        location.href = `/detailPost/${pidx}`;
    }
    posts.forEach(e => e.addEventListener('click', handlePostClick));
}

function main() {
    postClick();
}

function profile() {
    postClick();
}

function postStatistics() {
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const width = 500;
    const height = 500;
    canvas.width = width;
    canvas.height = height;
}