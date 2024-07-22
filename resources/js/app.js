import './bootstrap';
import axios from "axios";

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#auth-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const data = new FormData(form);
        const codeError = form.querySelector('.code-error');

        codeError.classList.add('hidden');
        codeError.textContent = '';

        axios.post(e.srcElement.action, {
            phone: data.get('phone'),
            code: data.get('code')
        })
            .then(function (res) {
                localStorage.setItem('access_token', res.data.result.token);
            })
            .catch(function (res) {
                codeError.classList.remove('hidden');
                codeError.textContent = res.response.data.message;
            })
    });

    const btnNext = form.querySelector('[name="next"]');
    btnNext.addEventListener('click', function () {
        const phone = form.querySelector('[name="phone"]').value;
        const phoneError = form.querySelector('.phone-error');
        const labelKey = form.querySelector('.label-code');
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
