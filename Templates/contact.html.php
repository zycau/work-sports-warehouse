<div id='contact-wraper'>
    <p class='error top'><?= $form->setTop() ?></p>
    <form action="contact.php" method="post" class='contact-form'>
        <fieldset class='form-field'>
            <legend>Contact us</legend>
            <p>
                <label for="firstName" >First Name*:</label>
                <input type="text" id='firstName' name='firstName' value='<?= $form->setValue('firstName') ?>' placeholder="John" class='<?= $form->setClass('firstName') ?>'/>
                <span><?= $form->name('firstName') ?></span>
            </p>
            <p>
                <label for="lastName">Last Name*:</label>
                <input type="text" id='lastName' name='lastName' value='<?= $form->setValue('lastName') ?>' placeholder='Smith' class='<?= $form->setClass('lastName') ?>'/>
                <span><?= $form->name('lastName') ?></span>
            </p>
            <p>
                <label for="contactNumber">Contact Number:</label>
                <input type="text" id='contactNumber' name='contactNumber' value='<?= $form->setValue('contactNumber') ?>' placeholder='0432888888' />
                <span></span>
            </p>
            <p>
                <label for="email">Email*:</label>
                <input type="email" id='email' name='email' value='<?= $form->setValue('email') ?>' placeholder="SportsWarehouse@gmail.com" class='<?= $form->setClass('email') ?>'/>
                <span><?= $form->email('email') ?></span>
            </p>
            <p>
                <label for="question">Your Question:</label>
                <textarea name="question" id="question" cols="30" rows="10" placeholder='Your Question'><?= $form->setValue('question') ?></textarea>
                <span></span>
            </p>                
        </fieldset>
        <p><input type="submit" name='submitForm' value='Submit'></p>
    </form>
</div>
<!-- contact us form validation -->
<script src="js/contactForm.js"></script>
