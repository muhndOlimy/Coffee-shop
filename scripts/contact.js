let name = document.getElementById("name");
let email = document.getElementById("email");
let message = document.getElementById("message");


name.validators = [requiredValidator, new MinLengthValidator(8), new MaxLengthValidator(45)];
email.validators = [requiredValidator, emailValidator];
message.validators = [requiredValidator, new MinLengthValidator(10), new MaxLengthValidator(100)];

let validationHooks = [new ValidatorHook(name), new ValidatorHook(email), new ValidatorHook(message)];

let form = document.forms[0];

form.onsubmit = (e) => {
    let errors = validationHooks.flatMap(el => {el.validate()});
    return errors.length == 0;
}

form.onreset = (e) => {
    validationHooks.foreach(el => {el.reset()});
    return true;
}