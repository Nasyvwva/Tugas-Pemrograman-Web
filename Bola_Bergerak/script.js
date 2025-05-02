const kanvas = document.getElementById("kanvas");
const ctx = kanvas.getContext("2d");

// Ukuran bola
const ukuranBola = 20;

// Posisi awal: pojok kiri-tengah canvas
let x = ukuranBola;
let y = kanvas.height / 2;

// Kecepatan gerak
const kecepatanX = 2;
const kecepatanY = 2;

// Arah gerak: "kanan", "turun", "kiri"
let arah = "kanan";

// Status animasi
let jalan = true;

// Fungsi animasi
function gambar() {
  ctx.clearRect(0, 0, kanvas.width, kanvas.height);

  // Gambar bola
  ctx.beginPath();
  ctx.arc(x, y, ukuranBola, 0, Math.PI * 2);
  ctx.fillStyle = "white";
  ctx.fill();
  ctx.closePath();

  // Pergerakan
  if (arah === "kanan") {
    if (x + ukuranBola + kecepatanX <= kanvas.width) {
      x += kecepatanX;
    } else {
      arah = "turun";
    }
  } else if (arah === "turun") {
    if (y + ukuranBola + kecepatanY <= kanvas.height) {
      y += kecepatanY;
    } else {
      arah = "kiri";
    }
  } else if (arah === "kiri") {
    if (x - ukuranBola - kecepatanX >= 0) {
      x -= kecepatanX;
    } else {
      jalan = false;
      ctx.clearRect(0, 0, kanvas.width, kanvas.height);
      return;
    }
  }

  if (jalan) {
    requestAnimationFrame(gambar);
  }
}

gambar();
