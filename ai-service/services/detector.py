from pathlib import Path
from datetime import datetime

import cv2
from ultralytics import YOLO

# ==========================================================
# LOAD MODEL
# ==========================================================

MODEL_PATH = Path(__file__).resolve().parent.parent / "model" / "best.pt"

model = YOLO(str(MODEL_PATH))

# ==========================================================
# FOLDER
# ==========================================================

BASE_DIR = Path(__file__).resolve().parent.parent

ORIGINAL_DIR = BASE_DIR / "uploads" / "original"
DETECTED_DIR = BASE_DIR / "uploads" / "detected"

ORIGINAL_DIR.mkdir(parents=True, exist_ok=True)
DETECTED_DIR.mkdir(parents=True, exist_ok=True)


# ==========================================================
# DETECTOR
# ==========================================================

def detect(image_path: str):

    detection_id = "AI" + datetime.now().strftime("%Y%m%d%H%M%S")

    # Cek file gambar
    image = cv2.imread(image_path)

    if image is None:
        print(f"[AI] Gagal membaca gambar: {image_path}")

        return {
            "detection_id": detection_id,
            "valid": False,
            "confidence": 0.0,
            "summary": {
                "bottle": False,
                "cap": False,
                "label": False
            },
            "objects": [],
            "original_image": f"/uploads/original/{Path(image_path).name}",
            "detected_image": None,
            "error": "Gambar tidak dapat dibaca"
        }

    print(f"[AI] Gambar berhasil dibaca: {image.shape}")

    # Jalankan YOLO
    results = model.predict(
        source=image,
        conf=0.5,
        verbose=False
    )

    if not results:
        print("[AI] YOLO tidak menghasilkan result.")

        return {
            "detection_id": detection_id,
            "valid": False,
            "confidence": 0.0,
            "summary": {
                "bottle": False,
                "cap": False,
                "label": False
            },
            "objects": [],
            "original_image": f"/uploads/original/{Path(image_path).name}",
            "detected_image": None,
            "error": "YOLO tidak menghasilkan result"
        }

    result = results[0]

    objects = []

    bottle = False
    cap = False
    label = False

    max_confidence = 0.0

    for box in result.boxes:

        class_id = int(box.cls[0])
        class_name = result.names[class_id]
        confidence = float(box.conf[0])

        max_confidence = max(max_confidence, confidence)

        if class_name == "bottle":
            bottle = True
        elif class_name == "cap":
            cap = True
        elif class_name == "label":
            label = True

        objects.append({
            "class": class_name,
            "confidence": round(confidence, 4)
        })

    # ======================================================
    # Simpan gambar hasil deteksi
    # ======================================================

    detected_image = result.plot()

    detected_filename = f"{detection_id}.jpg"

    detected_path = DETECTED_DIR / detected_filename

    cv2.imwrite(str(detected_path), detected_image)

    return {

        "detection_id": detection_id,

        "valid": bottle,

        "confidence": round(max_confidence, 4),

        "summary": {

            "bottle": bottle,

            "cap": cap,

            "label": label

        },

        "objects": objects,

        "original_image": f"/uploads/original/{Path(image_path).name}",

        "detected_image": f"/uploads/detected/{detected_filename}"

    }