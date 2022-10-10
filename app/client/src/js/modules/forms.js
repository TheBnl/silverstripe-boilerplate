import Pristine from 'pristinejs/dist/pristine.js';

export function initForms() {
  let config = {
    classTo: 'field',
    errorClass: 'error',
    // errorClass: 'is-invalid-input',
    // successClass: 'is-valid-input',
    successClass: 'has-success',
    errorTextParent: 'middleColumn',
    errorTextTag: 'span',
    errorTextClass: 'form-error'
  };

  Pristine.addMessages('nl', {
    required: "Dit veld is verplicht",
    email: "Dit veld vereist een valide e-mailadres",
    number: "Dit veld vereist een getal",
    integer: "Dit veld vereist een heel getal",
    url: "Dit veld vereist een valide website adres",
    tel: "Dit veld vereist een valide telefoonnummer",
    maxlength: "De tekstlengte moet minder dan ${1} zijn",
    minlength: "De tekstlengte moet groter dan ${1} zijn",
    min: "De de invoer moet minstens ${1} zijn",
    max: "De de invoer moet maximaal ${1} zijn",
    pattern: "De de invoer moet voldoen aan het format",
  });

  Pristine.setLocale('nl');

  // auto add pristine attributes to all forms
  let fields = document.querySelectorAll('[data-msg-required]');
  for (let i = 0; i < fields.length; i++) {
    fields[i].setAttribute('data-pristine-required-message', fields[i].getAttribute('data-msg-required'));
  }

  let forms = document.getElementsByTagName("form");
  for (let j = 0; j < forms.length; j++) {
    // create the pristine instance
    let form = forms[j];
    let pristine = new Pristine(form, config);
    form.addEventListener('submit', function (e) {
      if (pristine.validate()) {
        // e.submitter.disabled = true;
        e.submitter.classList.add('loading');
      } else {
        e.preventDefault();
      }
    });
  }
};
