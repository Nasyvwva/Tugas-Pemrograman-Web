const kanvas = document.getElementById("kanvas");
const ctx = kanvas.getContext("2d");

let ukBola = 20;
let x = kanvas.width / 2;
let y = ukBola;
let gerakX = 2;
let gerakY = 2;

let posisi = "kanan";
let jalanTerus = true;

function gambar() {
  ctx.clearRect(0, 0, kanvas.width, kanvas.height);

  ctx.beginPath();
  ctx.arc(x, y, ukBola, 0, Math.PI * 2);
  ctx.fillStyle = "white";
  ctx.fill();
  ctx.closePath();

  if (posisi === "kanan") {
    if (x + ukBola + gerakX <= kanvas.width) {
      x += gerakX;
    } else {
      posisi = "turun";
    }
  } else if (posisi === "turun") {
    if (y + ukBola + gerakY <= kanvas.height) {
      y += gerakY;
    } else {
      posisi = "kiri";
    }
  } else if (posisi === "kiri") {
    if (x - ukBola - gerakX >= 0) {
      x -= gerakX;
    } else {
      jalanTerus = false;
      ctx.clearRect(0, 0, kanvas.width, kanvas.height);
      return;
    }
  }

  if (jalanTerus) {
    requestAnimationFrame(gambar);
  }
}

gambar();
