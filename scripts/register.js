let namef = document.getElementById("name");
let email = document.getElementById("email");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirm-password");
let country = document.getElementById("country");

let gender = 'gender';
let interests = 'interests';

namef.validators = [requiredValidator, new MinLengthValidator(8), new MaxLengthValidator(45)];
email.validators = [requiredValidator, emailValidator];
password.validators = [requiredValidator, new MinLengthValidator(6), new MaxLengthValidator(20)];
confirmPassword.validators = [requiredValidator, new MatchValidator(password)];
country.validators = [requiredValidator];

let validationHooks = [ new ValidatorHook(namef), 
                        new ValidatorHook(email),
                        new ValidatorHook(password), 
                        new ValidatorHook(confirmPassword),
                        new ValidatorHook(country),
                        new ValidatorHook('gender', [requiredValidator]),
                        new ValidatorHook('interests', [requiredValidator])];

let form = document.forms[0];

form.onsubmit = (e) => {
    let errors = validationHooks.flatMap(el => {el.validate()});
    return errors.length == 0;
}

form.onreset = (e) => {
    validationHooks.foreach(el => {el.reset()});
    return true;
}