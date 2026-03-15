var button_selected = document.querySelector(".options_connexion .selected");
var button_unselected = document.querySelector(".options_connexion .unselected");
var form_connexion = document.querySelector(".form-connexion");
var form_inscription = document.querySelector(".form-inscription");

function changeSelect(inputToSelect) {
    if (inputToSelect == "login") {
        resetOutline(inputToSelect+"-username", "pseudonyme-invalide");
        // resetOutline(inputToSelect+"-username", "information-invalide");
        // Mettre à jour les classes des boutons pour refléter la sélection
        button_selected.classList.remove("unselected");
        button_selected.classList.add("selected");
        button_unselected.classList.remove("selected");
        button_unselected.classList.add("unselected");

        // Réinitialiser les champs de saisie
        document.querySelector("#" + inputToSelect + "-username").value = "";
        document.querySelector("#" + inputToSelect + "-password").value = "";

        // Afficher le formulaire de connexion et masquer le formulaire d'inscription
        form_connexion.style.display  = "block";
        form_inscription.style.display  = "none";
    } else if (inputToSelect == 'register') {
        resetOutline(inputToSelect+"-username", "pseudonyme-invalide");
        // resetOutline(inputToSelect+"-username", "information-invalide");
        resetOutline(inputToSelect+"-password", "is-invalide");
        resetOutline(inputToSelect+"-confirm-password", "information-invalide");
        // Mettre à jour les classes des boutons pour refléter la sélection
        button_selected.classList.remove("selected");
        button_selected.classList.add("unselected");
        button_unselected.classList.remove("unselected");
        button_unselected.classList.add("selected");

        // Réinitialiser les champs de saisie
        document.querySelector("#" + inputToSelect + "-username").value = "";
        document.querySelector("#" + inputToSelect + "-password").value = "";
        document.querySelector("#" + inputToSelect + "-confirm-password").value = "";

        // Afficher le formulaire d'inscription et masquer le formulaire de connexion
        form_connexion.style.display  = "none";
        form_inscription.style.display  = "block";
    }
}
changeSelect('login');

function validateUsername(classInput) {
    var usernameInput = document.getElementById(classInput);
    var username = usernameInput.value.trim();

    if (username.length < 3 || username.length > 20) {
        document.querySelector("." + classInput + "-pseudonyme-invalide").style.display = "block";
    document.querySelector("#" + classInput).classList.add("erreur-input");
        return false;
    }
    return true;
}

function validateUsername(classInput) {
    var usernameInput = document.getElementById(classInput);
    var username = usernameInput.value.trim();

    if (username.length < 3 || username.length > 20) {
        document.querySelector("." + classInput + "-pseudonyme-invalide").style.display = "block";
    document.querySelector("#" + classInput).classList.add("erreur-input");
        return false;
    }
    return true;
}

function validatePassword(classInput) {
    var passwordInput = document.getElementById(classInput);
    var password = passwordInput.value.trim();

    if (password.length < 6 || password.length > 100) {
        document.querySelector("." + classInput + "-is-invalide").style.display = "block";
        document.querySelector("#" + classInput).classList.add("erreur-input");
        return false;
    }
    return true;
}

function validateConfirmPassword(classInput) {
    var confirmPasswordInput = document.getElementById(classInput);
    var confirmPassword = confirmPasswordInput.value.trim();
    var passwordInput = document.getElementById(classInput.replace("confirm-password", "password"));
    var password = passwordInput.value.trim();

    if (confirmPassword !== password) {
        document.querySelector("." + classInput + "-information-invalide").style.display = "block";
        document.querySelector("#" + classInput).classList.add("erreur-input");
        // return false;
    }
    return true;
}

function resetOutline(classInput, errorType) {
    document.querySelector("." + classInput + "-" + errorType).style.display = "none";
    document.querySelector("#" + classInput).classList.remove("erreur-input");
}