const forms = {
  'MemberLoginForm_LoginForm_action_dologin': 'MemberLoginForm_LoginForm',
  'UserForm_Form_action_process': 'UserForm_Form'
};

/**
 * Pretend to do ajax sending
 *
 * @param formID
 */
const pretendToSend = function (formID) {
  let form = $(formID);
  let input = form.find('input[type="submit"]');

  if (form.valid() && !form.hasClass('ajax')) {
    input.addClass('loading');
  } else if (!form.valid()) {
    input.addClass('error');
  } else {
    input.removeClass('error');
  }

  return false;
};

/**
 * Bootstraps the forms
 */
export const initForms = () => {
  $.each(forms, (button, form) => {
    let buttonID = '#' + button;
    let formID = '#' + form;
    $(buttonID).on('click', (e) => {
      pretendToSend(formID);
    });
  });
};