const form = document.getElementById("form");
const formError = document.getElementById("formError");

form.addEventListener("change", evt => {

    // shortcut to the element that fired the event
    const target = evt.target;

    // clear the CustomValidity string, indicating that the developer considers the data valid
    // if this is not done, the .checkValidity() call will fail
    target.setCustomValidity("");

    // if there is a data-msg attribute, use as the message text, otherwise use "Error"
    const msg = target.getAttribute("title") ?? "Error";
    // check if the value is considered valid by the browser, if not display the message
    if (!target.checkValidity()) {
        target.setCustomValidity(msg);
    } else {
        // continue to check if the value matches the application constraints
        switch (target.id) {
            // to validate a textarea, you must put the id of the text area as a case
            case "five":
                const re = new RegExp(target.getAttribute("data-pattern"));
                if (!re.test(target.value)) {
                    target.setCustomValidity(msg);
                }
        }
    }
});

const btn = document.getElementById("submit");
btn.addEventListener("click",evt => {
    // check if all the form input elements are valid
    if (form.checkValidity()) {
        // send all the data to the server
        form.submit();
    } else {
        formError.classList.remove("hidden");
        // additional logic could be placed here to ensure selection of <option>s or radio buttons
        // this is being deliberately omitted because the emphasis of this lab is connecting the HTML to the CSS and JavaScript
    }
});