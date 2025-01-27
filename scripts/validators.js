
class Validator {
    validate(value, messages) {}
}

class RequiredValidator extends Validator {
    
    #errorMessage;
    
    constructor(errorMessage) {
        super();
        this.#errorMessage = errorMessage ?? `Value is required`;
    }

    validate(value, messages) {
        if (value == '') messages.push(this.#errorMessage);
    }
}

class MinLengthValidator extends Validator {
    
    #minLength;
    #errorMessage;
    
    constructor(minLength, errorMessage) {
        super();
        this.#minLength = minLength ?? 0;
        this.#errorMessage = errorMessage ?? `Value must be more than ${this.#minLength} chars`;
    }

    validate(value, messages) {
        if (value == '') return;
        if (value.length < this.#minLength) messages.push(this.#errorMessage);
    }
}

class MaxLengthValidator extends Validator {
    
    #maxLength;
    #errorMessage;
    
    constructor(maxLength, errorMessage) {
        super();
        this.#maxLength = maxLength ?? 0;
        this.#errorMessage = errorMessage ?? `Value must be less than ${this.#maxLength} chars`;
    }

    validate(value, messages) {
        if (value == '') return;
        if (value.length > this.#maxLength) messages.push(this.#errorMessage);
    }
}

class RegexValidator extends Validator {
    
    #pattern;
    #errorMessage;
    
    constructor(pattern, errorMessage) {
        super();
        this.#pattern = pattern;
        this.#errorMessage = errorMessage ?? `Value must match the pattern ${this.#pattern}`;
    }

    validate(value, messages) {
        if (value == '') return;
        if (!this.#pattern.test(value)) messages.push(this.#errorMessage);
    }
}

class MatchValidator extends Validator {
    
    #element;
    #errorMessage;
    
    constructor(element, errorMessage) {
        super();
        this.#element = element;
        this.#errorMessage = errorMessage ?? `Value must match the value ${this.#element.value}`;
    }

    validate(value, messages) {
        if (value == '') return;
        if (this.#element.value !== value) messages.push(this.#errorMessage);
    }
}

class ValidatorHook {
    #error;
    #validators;
    #element;

    constructor(element, validators, error) {
        this.#element = element;
        this.#validators = validators ?? element.validators;
        this.#error = error ?? document.getElementById(this.#getId(element) + '_error');
    }

    validate() {
        let messages = [];
        if (this.#validators) {
            let value = this.#getValue(this.#element);
            this.#validators.forEach(element => {
                element.validate(value, messages);
            });
        }
        if (this.#error) {
            if (messages.length > 0) {
                this.#error.textContent = messages.join("\n");
                this.#error.style.display = 'unset';
            } else {
                this.#error.textContent = null;
                this.#error.style.display = 'none';
            }
        }
        return messages;
    }

    reset() {
        this.#error.textContent = null;
        this.#error.style.display = 'none';
    }

    #getId(element) {
        if (typeof(element) === 'string') {
            return element;
        }
        return element.id;
    }

    #getValue(element) {
        if (typeof(element) === 'string') {
            let el = document.getElementById(element);
            if (el) {
                return el.value;
            }
            let els = document.getElementsByName(element);
            let value = [];
            els.forEach(el => {
                let checked = el['checked'];
                if (checked) {
                    value.push(el['value'] ?? checked);
                }
            });
            return value;
        }
        return element.value;
    }
}

const emailRegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
var emailValidator = new RegexValidator(emailRegExp, "Value must be an email");
var requiredValidator = new RequiredValidator();