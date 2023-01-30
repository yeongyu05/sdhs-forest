const mainId = document.querySelector('main').id;
mainId === 'main' ? main() :
mainId === 'detailPost' ? detailPost() :
mainId === 'profile' ? profile() :
mainId === 'postStatistics' ? postStatistics() :
mainId;

function detailPost() {
    const form = document.querySelector('form');
    const input = document.querySelector('input');
    const handleFormSubmit = e => {
        e.preventDefault();
        form.submit();
        input.value = '';
    }
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
    ctx;
}