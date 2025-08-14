document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("loginForm2");
    const validationForm = document.getElementById("loginForm3");


    const form = loginForm || registerForm || validationForm;

    const passwordInput = form.querySelector('input[name="password"]');

    passwordInput.addEventListener("input", passwordCheck);

    function passwordCheck() {
        handleValidateLowerCase();
        handleValidateCapsLock();
        handleValidateNumber();
        handleValidateLength();
        handleValidateSpecial();
        handleValidateNotUser();
    }


    function handleValidateCapsLock() {
        const password = passwordInput.value;
        const IncludeCapsLock = contientMajuscule(password);

        const li = form.querySelector("#consigne2");
        if (IncludeCapsLock === true) {
            li.classList.add("valid-rule");
            li.style.cssText = "color: #9adbb3; font-weight : 900";
        } else {
            li.style.cssText = "color: #D3D3D3; font-weight : 500";
            li.classList.remove("valid-rule");
        }
    }

    function contientMajuscule(mot) {
        const characters = mot.split("");

        for (let i = 0; i < mot.length; i++) {
            if (isMajuscule(characters[i])) {
                return true;
            }
        }
        return false;
    }

    function isMajuscule(lettre) {
        return lettre >= 'A' && lettre <= 'Z';
    }


    function handleValidateLowerCase() {
        const password = passwordInput.value;
        const IncludeLowerCase = contientMinuscule(password);

        const li = form.querySelector("#consigne1");
        if (IncludeLowerCase === true) {
            li.classList.add("valid-rule");
            li.style.cssText = "color: #9adbb3; font-weight : 900";
        } else {
            li.style.cssText = "color: #D3D3D3; font-weight : 500";
            li.classList.remove("valid-rule");
        }
    }

    function contientMinuscule(mot) {
        const characters = mot.split("");

        for (let i = 0; i < mot.length; i++) {
            if (isMinuscule(characters[i])) {
                return true;
            }
        }
        return false;
    }

    function isMinuscule(lettre) {
        return lettre >= 'a' && lettre <= 'z';
    }

    function handleValidateNumber() {
        const password = passwordInput.value;
        const IncludeNumber = contientNombre(password);

        const li = form.querySelector("#consigne3");
        if (IncludeNumber === true) {
            li.classList.add("valid-rule");
            li.style.cssText = "color: #9adbb3; font-weight : 900";
        } else {
            li.style.cssText = "color: #D3D3D3; font-weight : 500";
            li.classList.remove("valid-rule");
        }
    }

    function contientNombre(mot) {
        for (let i = 0; i < mot.length; i++) {
            if (!isNaN(Number(mot[i]))) {
                return true;
            }
        }
        return false;
    }

    function handleValidateLength() {
        const password = passwordInput.value;
        const IncludeLongueur = longueur6(password);

        const li = form.querySelector("#consigne4");
        if (IncludeLongueur === true) {
            li.classList.add("valid-rule");
            li.style.cssText = "color: #9adbb3; font-weight : 900";
        } else {
            li.style.cssText = "color: #D3D3D3; font-weight : 500";
            li.classList.remove("valid-rule");
        }
    }

    function longueur6(mot) {
        return mot.length >= 6;
    }

});
