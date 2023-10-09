{

  // set validation messages
  let customMessage = document.querySelectorAll('[data-msg-required]');
  Array.from(customMessage).forEach(el => {
    // skip type="radio" and type="checkbox"
    
    if (['radio', 'checkbox'].includes(el.getAttribute('type'))) {
      return;
    }

    const message = el.getAttribute('data-msg-required');
    const messageEl = document.createElement('div');
    messageEl.classList.add('invalid-feedback');
    messageEl.innerHTML = message;
    el.parentNode.insertBefore(messageEl, el.nextSibling);
  });

  let forms = document.getElementsByTagName('form');
  Array.from(forms).forEach(form => {
    form.setAttribute('novalidate', true);
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
}