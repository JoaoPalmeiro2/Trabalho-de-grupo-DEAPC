// Captura elementos do modal e inputs
var modal = document.getElementById("testDriveModal");
var carModelNameSpan = document.getElementById("carModelName");
var carModelInput = document.getElementById("car_model_input");
var form = modal.querySelector("form");
var dateInput = document.getElementById("test_drive_date");

// Função para abrir o modal com o nome do carro
function openTestDriveModal(carModel) {
    carModelNameSpan.textContent = carModel;
    carModelInput.value = carModel;
    modal.style.display = "block";

    // Limpa input da data quando abrir modal
    dateInput.value = "";
}

// Função para fechar o modal
function closeTestDriveModal() {
    modal.style.display = "none";
}

// Fecha modal clicando fora da caixa
window.onclick = function(event) {
    if (event.target == modal) {
        closeTestDriveModal();
    }
}

// Validação do formulário: a data deve ser pelo menos 7 dias após a data atual
form.addEventListener("submit", function(event) {
    var selectedDate = new Date(dateInput.value);
    var today = new Date();

    // Ajusta a data atual para o início do dia (00:00)
    today.setHours(0,0,0,0);

    // Calcula diferença em milissegundos
    var diff = selectedDate - today;

    // 7 dias em milissegundos
    var minDiff = 7 * 24 * 60 * 60 * 1000;

    if (diff < minDiff) {
        alert("❌ Não é possível marcar o Test Drive com menos de 7 dias após a data atual.");
        event.preventDefault(); // bloqueia o envio do formulário
    }
});
