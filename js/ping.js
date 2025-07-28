// session activity monitor
// if the user doesn't click the mouse button or change data in the form for 30 seconds, end the session

// this is a flag to indicate the user did something - either clicked a mouse button or changed a form value
let action = false;

async function ping() {
    // this will be displayed in the browser console - it is helpful for debugging
    console.debug('ping');
    try {
        // ping if there was action, end the session if there has not been action for 30 seconds (30 seconds may be a bit harsh)
        const url = action ? 'ping.php' : 'session-end.php';
        // send a request to the server - if a 204 comes back, it's good
        const response = await fetch(url);
        if (!response.status === 204) {
            // backticks allow variable substitution
            throw new Error(`ping failed ${response.status}`);
        }
        if (!action) {
            location.href = '/';
        }
        // clear the action flag
        action = false;
    } catch(error) {
        console.error(error.message);j
    }
}

// every 60 seconds call the ping function
setInterval(ping, 60000);

// every time a person clicks the mouse button or changes a value on the form, set the action flag to show they are active

function logAction() {
    console.debug('action');
    action = true;
}

document.addEventListener('click', logAction );
document.addEventListener('input', logAction );