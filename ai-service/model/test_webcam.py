from ultralytics import YOLO
import cv2

# Load model
model = YOLO("best.pt")

# Buka webcam
cap = cv2.VideoCapture(0)

if not cap.isOpened():
    print("Webcam tidak bisa dibuka.")
    exit()

print("Webcam aktif.")
print("Tekan Q untuk keluar.")

while True:
    ret, frame = cap.read()

    if not ret:
        print("Gagal membaca frame webcam.")
        break

    # Deteksi
    results = model(frame, conf=0.5, verbose=False)

    # Gambar hasil deteksi
    annotated_frame = results[0].plot()

    # Tampilkan
    cv2.imshow("YOLO - Bottle Detection", annotated_frame)

    # Tekan Q untuk keluar
    if cv2.waitKey(1) & 0xFF == ord("q"):
        break

cap.release()
cv2.destroyAllWindows()