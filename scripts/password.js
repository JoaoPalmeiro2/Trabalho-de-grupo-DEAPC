document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const form = document.getElementById("loginForm");

   
    form.addEventListener("submit", (e) => {
        const password = passwordInput.value;

        if (password.length < 4) {
            alert("A palavra-passe deve ter pelo menos 4 caracteres.");
            e.preventDefault();  
        }
    });
});