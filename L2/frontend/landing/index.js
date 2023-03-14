// js code that will to open login popup
  const loginLinks = document.querySelectorAll('#to-popup');
  const closeBtn = loginPopup.querySelector('.close');

  loginLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault(); 
      loginPopup.style.display = 'block'; 
    });
  });
  closeBtn.addEventListener('click', () => {
    loginPopup.style.display = 'none';
  });
