$(function(){
    // disabled HTML form validation
    $('.pay-form').attr('novalidate','');
    
    // 当点击pay时
    $('.pay-form').on('submit', function(e){
        // 隐藏所有错误信息
        hideError(); 

        let cardNumber = $(this).find('#cardNumber');
        let expiry = $(this).find('#expiryDate');
        let name = $(this).find('#nameOnCard');
        let csv = $(this).find('#csv');

        // 验证信用卡号码
        if(cardNumber.val().trim().length == 0){
            showError(cardNumber,e,'Please enter credit card number');
        }else if(!cardNumberReg.test(cardNumber.val().trim())){
            showError(cardNumber,e,'Invalid credit card number');
        }

        // 验证expiryDate填写，分三种情况：一是没有填写，二是Regex检查填写格式不是mm/yy，三是卡已经过期。
        if(expiry.val().trim().length == 0){
            showError(expiry,e,'Please enter the expiry date');
        }else if(!expiryReg.test(expiry.val().trim())){
            showError(expiry,e,'Invalid expiry date');
        }else if(parseInt(expiry.val().trim().substr(3,2),10)<yy || (parseInt(expiry.val().trim().substr(3,2),10)==yy && parseInt(expiry.val().trim().substr(0,2),10)<mm)){
            showError(expiry,e,'The card has expired');
        }

        // 验证nameOnCard填写
        if(name.val().trim().length<2){            
            showError(name,e,'At least 2 characters');           
        }

        // 验证CSV的填写
        if(csv.val().trim().length == 0){
            showError(csv,e,'Please enter CSV number');
        }else if(!csvReg.test(csv.val().trim())){
            showError(csv,e,'Invalid CSV number');
        } 

        
    })

    const cardNumberReg = /^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/;
    
    let today = new Date();
    let mm = parseInt((today.getMonth()+1).toString().padStart(2,'0'),10); //1月份是0
    let yyyy = today.getFullYear();
    let yy = parseInt(yyyy.toString().substr(-2), 10);

    const expiryReg = /^((0[1-9])|(1[0-2]))\/[0-9]{2}$/;

    const csvReg = /^[0-9]{3,4}$/


    
    const showError = (input, event, message)=>{
        event.preventDefault();
        input.siblings('span').html(message);
        input.parents().find('.top').html('Please fill the required content correctly.');
    }

    const hideError = ()=>{
        $('#pay-wraper').find('span').html('');
        $('#pay-wraper').find('.top').html('');
    }

})