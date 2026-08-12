from ultralytics import YOLO

model = YOLO("best.pt")

print("Nama class:")
print(model.names)

print("\nJumlah class:")
print(len(model.names))