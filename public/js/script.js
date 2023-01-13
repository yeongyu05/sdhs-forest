const mainId = document.querySelector('main').id;
mainId === 'detailPost' ? detailPost() :
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