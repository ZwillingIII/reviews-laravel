import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#auth-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // console.log(e);
    });

    const btnNext = form.querySelector('[name="next"]');
    btnNext.addEventListener('click', function () {
        const phone = form.querySelector('[name="phone"]').value;
        const phoneError = form.querySelector('.phone-error');
        const labelKey = form.querySelector('.label-key');
        const submitBtn = form.querySelector('[type=submit]');

        phoneError.classList.add('hidden');
        phoneError.textContent = '';

        axios.post('/api/validate', {
            phone: phone
        })
            .then(function (response) {
                labelKey.classList.remove('hidden');
                btnNext.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            })
            .catch(function (error) {
                phoneError.textContent = error.response.data.error.message;
                phoneError.classList.remove('hidden');
            });
    })
})
