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
    postClick();
}

function postStatistics() {
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const width = 800;
    const height = 450;
    canvas.width = width;
    canvas.height = height;
      
    // const weeks = {};
    // all.forEach(v => {
    //   const date = new Date(v.date);
    //   const startOfWeek = new Date(date);
    //   startOfWeek.setDate(date.getDate() - date.getDay());
    //   const week = startOfWeek.toISOString().split("T")[0];
    //   if (!weeks[week]) {
    //     weeks[week] = [];
    //   }
    //   weeks[week].push(v);
    // });

    const weeks = [];
    all.forEach(v => {
      const date = new Date(v.date);
      const startOfWeek = new Date(date);
      startOfWeek.setDate(date.getDate() - date.getDay());
      const week = startOfWeek.toISOString().split("T")[0];
    //   weeks.some(e => e.date === week);
    //   weeks = [
    //     ...weeks,

    //   ]

      if (!weeks[week]) {
        weeks[week] = [];
      }
      weeks[week].push(v);
    });

    console.log(weeks);

    function render() {
        const weekData = [
            {
                '2023-01-22': [
                    {date: '2023-01-27'},
                    {date: '2023-01-28'},
                ],
                '2023-01-29': [
                    {date: '2023-01-30'},
                    {date: '2023-01-31'},
                ],
            }
        ]
        const data =  [
            {
                date: '2023-01-22',
                count: 5,
            },
            {
                date: '2023-01-29',
                count: 18,
            },
        ]
        
        const dummy = [
            {
                title: 'asdf',
                newValue: 123,
                oldValue: 456,
            },
            {
                title: 'asdf',
                newValue: 123,
                oldValue: 456,
            },
            {
                title: 'asdf',
                newValue: 123,
                oldValue: 456,
            },
        ]
    }

    // render();
}