let firstName = document.getElementById("first-name");
let lastName = document.getElementById("last-name");
let email = document.getElementById("email");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirm-password");
let country = document.getElementById("country");
let state = document.getElementById("state");

firstName.validators = [requiredValidator, new MinLengthValidator(5), new MaxLengthValidator(45)];
lastName.validators = [requiredValidator, new MinLengthValidator(5), new MaxLengthValidator(45)];
email.validators = [requiredValidator, emailValidator];
password.validators = [requiredValidator, new MinLengthValidator(6), new MaxLengthValidator(20)];
confirmPassword.validators = [requiredValidator, new MatchValidator(password)];
country.validators = [requiredValidator];
state.validators = [requiredValidator];

let validationHooks = new ValidatorHooksAggregator([
    new ValidatorHook(firstName),
    new ValidatorHook(lastName),
    new ValidatorHook(email),
    new ValidatorHook(password),
    new ValidatorHook(confirmPassword),
    new ValidatorHook(country),
    new ValidatorHook(state),
    new ValidatorHook('gender', [requiredValidator]),
    new ValidatorHook('interests[]', [requiredValidator])]);

let form = document.forms[0];

form.onsubmit = (e) => {
    let errors = validationHooks.validate();
    return errors.length === 0;
}

form.onreset = (e) => {
    validationHooks.foreach(el => {
        el.reset()
    });
    return true;
}