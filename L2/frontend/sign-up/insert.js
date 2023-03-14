const form = document.querySelector('#registration-form');
const passwordInput = form.querySelector('#password');
const confirmPasswordInput = form.querySelector('#confirmpassword');
const errorMessage = form.querySelector('.error');

form.addEventListener('submit', (event) => {
  if (passwordInput.value !== confirmPasswordInput.value) {
    event.preventDefault();
    errorMessage.textContent = 'Passwords do not match. Please try again.';
    errorMessage.style.display = 'block';
  }
});
