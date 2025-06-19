var modal = document.getElementById("testDriveModal");
var carModelNameSpan = document.getElementById("carModelName");
var carModelInput = document.getElementById("car_model_input");
var form = modal.querySelector("form");
var dateInput = document.getElementById("test_drive_date");

function openTestDriveModal(carModel) {
    carModelNameSpan.textContent = carModel;
    carModelInput.value = carModel;
    modal.style.display = "block";

    dateInput.value = "";
}

function closeTestDriveModal() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        closeTestDriveModal();
    }
}

form.addEventListener("submit", function(event) {
    var selectedDate = new Date(dateInput.value);
    var today = new Date();

    today.setHours(0, 0, 0, 0);


    var diff = selectedDate - today;


    var minDiff = 7 * 24 * 60 * 60 * 1000;

    if (diff < minDiff) {
        alert("❌ Não é possível marcar o Test Drive com menos de 7 dias após a data atual.");
        event.preventDefault();
    }
});