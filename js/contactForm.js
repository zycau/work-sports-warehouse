$(function(){
    $('.contact-form').attr('novalidate','');

    $('.contact-form').on('submit', function(e){
        
        hideError();

        let firstName = $(this).find('#firstName');
        let lastName = $(this).find('#lastName');
        let phone = $(this).find('#contactNumber');
        let email = $(this).find('#email');
        let question = $(this).find('#question');

        if(firstName.val().trim().length<2){
            showError(firstName, e, 'At least 2 characters');
        }

        if(lastName.val().trim().length<2){
            showError(lastName, e, 'At least 2 characters');
        }

        if(phone.val().trim().length>0 && !phoneReg.test(phone.val().trim())){
            showError(phone, e, 'Invalid Australian phone number');
        }

        if(email.val().trim().length == 0){
            showError(email, e, 'Email address is required');
        }else if(!emailReg.test(email.val().trim())){
            showError(email, e, 'Invalid email address');
        }

        if(question.val().trim().length==0){
            showError(question, e, 'Question is required');
        }else if(question.val().trim().length<30){
            showError(question, e, 'At least 30 characters');
        }


    })

    const phoneReg = /^((000|112|106)|(((\+61 ?\(?0?[- ]?)|(\(?0[- ]?))[23478]\)?([- ]?[0-9]){8})|((13|18)([- ]?[0-9]){4}|(1300|1800|1900)([- ]?[0-9]){6}))$/;

    const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    const showError = (input, event, message)=>{
            event.preventDefault();
            input.siblings('span').html(message);
            input.parents().find('.top').html('Please fill the required content correctly.');
        }

    const hideError = ()=>{
        $('#contact-wraper').find('span').html('');
        $('#contact-wraper').find('.top').html('');
    }
})