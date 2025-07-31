const form = document.getElementById("form");
const formError = document.getElementById("formError");

form.addEventListener("change", evt => {

    const target = evt.target;

    target.setCustomValidity("");

    const msg = target.getAttribute("title") ?? "Error";
    if (!target.checkValidity()) {
        target.setCustomValidity(msg);
    } else {
        switch (target.id) {
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
    if (form.checkValidity()) {
        form.submit();
    } else {
        formError.classList.remove("hidden");
    }
});