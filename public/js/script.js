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
    const handelCommentClick = e => {
        if(e.target.classList.contains('nestedC')) return;
        const form = e.currentTarget.parentNode.parentNode;
        if(form.nestedCommentInput) return;
        const input = document.createElement('input');
        const hiddenInput = document.createElement('input');
        input.type = 'text';
        input.name = 'nestedCommentInput';
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'cidx';
        hiddenInput.value = e.currentTarget.dataset.cidx;
        e.currentTarget.appendChild(input);
        e.currentTarget.appendChild(hiddenInput);
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
    const tabs = [...document.querySelectorAll('.tabs > div')];
    const article = [...document.querySelectorAll('article')];
    const handleTabsClick = ({currentTarget}) => {
        if(currentTarget.classList.contains('selected')) return;
        tabs.forEach(e => e.classList.toggle('selected'));
        article.forEach(e => e.classList.toggle('none'));
    }
    tabs.forEach(tab => tab.addEventListener('click', handleTabsClick));
    postClick();
}

function postStatistics() {
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const canvasWidth = 800;
    const height = 450;
    canvas.width = canvasWidth;
    canvas.height = height;

    const setData = () => {
        let weekly = [];
        let week = new Date();
        for(let i = 0; i < 5; i++) {
            week = i === 0 ?
            new Date(week.getFullYear(), week.getMonth(), week.getDate() - week.getDay()) :
            new Date(week.getFullYear(), week.getMonth(), week.getDate() - 7);
            week.setHours(week.getHours() + 9);
            const date = week.toISOString().split("T")[0];
            weekly = [{date, count: 0}, ...weekly];
        }
        visitors.forEach(v => {
            const date = new Date(v.date);
            const endOfWeek = new Date(date);
            endOfWeek.setDate(date.getDate() - date.getDay() + 7);
            const week = endOfWeek.toISOString().split("T")[0];
            weekly.forEach(e => e.date === week ? e.count += 1 : false);
        })
        return weekly;
    }

    const render = () => {
        const data = setData();
        const length = data.length;
        const [pl, pr, pt, pb] = [50, 0, 25, 50];
        const max = Math.max(...data.map(e => e.count)) !== 0 ?
        Math.max(...data.map(e => e.count)) : 10;
        const limit = Math.ceil(max / 10);
        const maxHeight = (height - pt - pb);
        const maxValue = Math.ceil(max / limit) * limit;
        const rowCount = Math.round(maxValue / limit);
        const rowLimit = maxHeight / rowCount;
        const p = maxHeight / maxValue;
        const insideWidth = (canvasWidth - pl - pr);
        const interval = insideWidth / (length * 2 + 1);
        const maxWidth = insideWidth - interval * 2;
        const gap = (maxWidth - interval * length) / (length !== 1 ? length - 1 : length);
        
        for (let i = 0; i <= rowCount; i++) {
            const y = height - (i * rowLimit) - pb;
            ctx.beginPath();
            ctx.textAlign = 'right';
            ctx.fillStyle = '#eee';
            ctx.fillRect(pl, y, canvasWidth - pr, 1);

            ctx.textAlign = 'center';
            ctx.fillStyle = '#777';
            ctx.fillText(limit * i, pl - 5, y + 5);
        }

        data.forEach(({date, count}, idx) => {
            const x = pl + interval + (interval * idx) + (gap * idx);
            const y = pt + maxHeight - p * count;
            const height = p * count;

            ctx.beginPath();
            ctx.fillStyle = '#888';
            ctx.fillRect(x, y, interval, height);
            
            ctx.fillStyle = 'red';
            ctx.font = '1rem serif bold';
            ctx.fillText(count, x + interval / 2, y - 5);

            ctx.fillStyle = 'blue';
            ctx.fillText(date, x + interval / 2, pt + maxHeight + pb / 3);
        });
    }

    render();
}