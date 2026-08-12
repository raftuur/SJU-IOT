document.addEventListener("DOMContentLoaded", () => {

    const buttons = document.querySelectorAll(".btn-detail");

    buttons.forEach(button => {

        button.addEventListener("click", function () {

            document.getElementById("detectionId").textContent =
                this.dataset.detectionId;

            document.getElementById("confidence").textContent =
                this.dataset.confidence + "%";

            document.getElementById("bottle").innerHTML =
                this.dataset.bottle == 1
                    ? '<span class="badge bg-success">Detected</span>'
                    : '<span class="badge bg-danger">Not Detected</span>';

            document.getElementById("cap").innerHTML =
                this.dataset.cap == 1
                    ? '<span class="badge bg-success">Detected</span>'
                    : '<span class="badge bg-danger">Not Detected</span>';

            document.getElementById("label").innerHTML =
                this.dataset.label == 1
                    ? '<span class="badge bg-success">Detected</span>'
                    : '<span class="badge bg-danger">Not Detected</span>';

            document.getElementById("status").innerHTML =
                this.dataset.bottle == 1
                    ? '<span class="badge bg-success">VALID</span>'
                    : '<span class="badge bg-danger">INVALID</span>';

            document.getElementById("originalImage").src =
                "http://127.0.0.1:8000" + this.dataset.originalImage;

            document.getElementById("detectedImage").src =
                "http://127.0.0.1:8000" + this.dataset.detectedImage;

        });

    });

    const thumbs = document.querySelectorAll(".detection-thumb");

    thumbs.forEach(img => {

        img.addEventListener("click", function () {

            document.getElementById("previewImage").src = this.src;

            const modal = new bootstrap.Modal(
                document.getElementById("imageModal")
            );

            modal.show();

        });

    });

});