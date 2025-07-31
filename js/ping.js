let action = false;

async function ping() {
    console.debug('ping');
    try {
        const url = action ? 'ping.php' : 'session-end.php';
        const response = await fetch(url);
        if (!response.status === 204) {
            throw new Error(`ping failed ${response.status}`);
        }
        if (!action) {
            location.href = '/';
        }
        action = false;
    } catch(error) {
        console.error(error.message);j
    }
}

setInterval(ping, 60000);

function logAction() {
    console.debug('action');
    action = true;
}
document.addEventListener('click', logAction );
document.addEventListener('input', logAction );