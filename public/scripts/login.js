let email = document.getElementById("email");
let password = document.getElementById("password");



email.validators = [requiredValidator, emailValidator];
password.validators = [requiredValidator, new MinLengthValidator(6), new MaxLengthValidator(20)];

let validationHooks = new ValidatorHooksAggregator([new ValidatorHook(email), new ValidatorHook(password)]);

let form = document.forms[0];

form.onsubmit = (e) => {
    let errors = validationHooks.validate();
    return errors.length === 0;
}

form.onreset = (e) => {
    validationHooks.foreach(el => {el.reset()});
    return true;
}