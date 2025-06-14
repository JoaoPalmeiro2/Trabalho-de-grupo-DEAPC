document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#form-testdrive");
  const dateInput = document.querySelector("#test_drive_date");
  const errorMessage = document.querySelector("#erro-mensagem");

  form.addEventListener("submit", function (event) {
    const today = new Date();
    const selectedDate = new Date(dateInput.value);

    // Zerar horas para comparação exata de datas
    today.setHours(0, 0, 0, 0);
    selectedDate.setHours(0, 0, 0, 0);

    // Calcular diferença em dias
    const diffTime = selectedDate.getTime() - today.getTime();
    const diffDays = diffTime / (1000 * 60 * 60 * 24);

    if (diffDays < 7) {
      event.preventDefault(); // Impede envio do formulário
      errorMessage.textContent = "❌ Não é possível marcar um test drive com menos de 7 dias de antecedência.";
      errorMessage.style.display = "block";
    } else {
      errorMessage.textContent = "";
      errorMessage.style.display = "none";
    }
  });
});
