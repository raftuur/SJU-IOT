from pathlib import Path
import shutil
import uuid

from fastapi import FastAPI, UploadFile, File
from fastapi.staticfiles import StaticFiles

from services.detector import model, detect

app = FastAPI(
    title="SJU AI Service",
    version="1.0.0"
)

# Folder uploads dapat diakses dari browser
app.mount("/uploads", StaticFiles(directory="uploads"), name="uploads")


@app.get("/")
def root():
    return {
        "success": True,
        "message": "SJU AI Service Running",
        "model_loaded": model is not None
    }


@app.get("/health")
def health():
    return {
        "status": "healthy"
    }


@app.post("/detect")
async def detect_image(file: UploadFile = File(...)):
    """
    Upload gambar lalu jalankan AI Detection.
    """

    # Folder original
    original_dir = Path("uploads/original")
    original_dir.mkdir(parents=True, exist_ok=True)

    # Nama file sementara
    filename = f"{uuid.uuid4()}.jpg"

    image_path = original_dir / filename

    # Simpan gambar upload
    with open(image_path, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)

    # Jalankan AI
    result = detect(str(image_path))

    return {

        "success": True,

        "message": "Detection completed",

        "detection_id": result["detection_id"],

        "valid": result["valid"],

        "confidence": result["confidence"],

        "summary": result["summary"],

        "objects": result["objects"],

        "original_image": result["original_image"],

        "detected_image": result["detected_image"]

    }