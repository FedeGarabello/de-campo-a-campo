const messageContainer = document.getElementById('message-container');
const showMessage = (message, type = 'success') => {
    const div = document.createElement('div');
    div.className = `message ${type}`;
    div.textContent = message;
    messageContainer.appendChild(div);

    setTimeout(() => {
        div.remove();
    }, 3000);
};