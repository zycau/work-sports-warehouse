$(function(){
    // disabled HTML form validation
    $('.checkout-form').attr('novalidate','');
    
    // 当点击提交时    
    $('.checkout-form').on('submit', function(e){
        // 隐藏所有错误信息
        hideError();

        let firstName = $(this).find('#firstName');
        let lastName = $(this).find('#lastName');
        let phone = $(this).find('#contactNumber');
        let email = $(this).find('#email');
        let postcode = $(this).find('#postcode');
        let address = $(this).find('#address');
        
        // 验证firstName填写
        if(firstName.val().trim().length<2){            
            showError(firstName,e,'At least 2 characters');
        }

        // 验证lastName填写
        if(lastName.val().trim().length<2){            
            showError(lastName,e,'At least 2 characters');           
        }

        // 验证是否澳洲电话号码
        if(phone.val().trim().length == 0){
            showError(phone,e,'Please enter the contact number');
        }else if(!phoneReg.test(phone.val().trim())){
            showError(phone,e,'Invalid Australian phone number');
        }

        // 如果填写了email，验证是否有效
        if(email.val().trim().length>0 && !emailReg.test(email.val().trim())){
            showError(email,e,'Invalid email address');
        }

        // 验证postcode填写
        if(postcode.val().trim().length == 0){
            showError(postcode,e,'Please enter the postcode');
        }else if(!postcodeReg.test(postcode.val().trim())){
            showError(postcode,e,'Invalid Australian postcode');
        }

        // 验证address填写
        if(address.val().trim().length<2){            
            showError(address,e,'At least 2 characters');
        }

        
    })

    const phoneReg = /^((000|112|106)|(((\+61 ?\(?0?[- ]?)|(\(?0[- ]?))[23478]\)?([- ]?[0-9]){8})|((13|18)([- ]?[0-9]){4}|(1300|1800|1900)([- ]?[0-9]){6}))$/;

    const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    const postcodeReg = /^[0-9]{3,4}$/;

    
    const showError = (input, event, message)=>{
        event.preventDefault();
        input.siblings('span').html(message);
        input.parents().find('.top').html('Please fill the required content correctly.');
    }

    const hideError = ()=>{
        $('#checkout-wraper').find('span').html('');
        $('#checkout-wraper').find('.top').html('');
    }


    


})

