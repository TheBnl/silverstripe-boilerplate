(($) => {
    'use strict';

    $.validator.addMethod("password", (value) => {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value); // has a digit
        // TODO: take the string from a lang file
    }, 'Het wachtwoord moet minstens één letter en één cijfer bevatten.');

    const forms = {
        'MemberLoginForm_LoginForm_action_dologin': 'MemberLoginForm_LoginForm',
        'UserForm_Form_action_process': 'UserForm_Form'
    };

    // If Foundation modules are installed uncomment this line
    //$(document).foundation();

    $(document).ready(() => {
        bootstrapForms(forms);
        initNavigation();
    });


    /**
     * Bootstraps the forms
     *
     * @param forms
     */
    function bootstrapForms(forms) {
        $.each(forms, (button, form) => {
            let buttonID = '#' + button;
            let formID = '#' + form;
            $(buttonID).on('click', (e) => {
                pretendToSend(formID);
            });

            if (formID != 'UserForm_Form') {
                $(formID).validate();
            }
        });
    }


    /**
     * Pretend to do ajax sending
     *
     * @param formID
     */
    function pretendToSend(formID) {
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
    }


    /**
     * Toggle the active class on the hamburger
     * Set navigation and navigationActive strings to your used classes
     */
    function initNavigation() {
        let hamburger = $('.c-hamburger');
        let navigation = $('.your-nav-class');
        let navigationActive = 'your-nav-class--active';

        hamburger.on('click', () => {
            hamburger.toggleClass('is-active');
            navigation.toggleClass(navigationActive);
        });
    }

})(jQuery);
