// canvas.js - Placeholder for tracing (if needed)

const canvas = document.getElementById('shapeCanvas');
const ctx = canvas.getContext('2d');
let tracing = false;

function drawTriangle() {
  ctx.beginPath();
  ctx.moveTo(200, 50);
  ctx.lineTo(100, 300);
  ctx.lineTo(300, 300);
  ctx.closePath();
  ctx.strokeStyle = '#f4a261';
  ctx.lineWidth = 2;
  ctx.stroke();
}

function startTracing(e) {
  tracing = true;
  const x = e.offsetX;
  const y = e.offsetY;
  ctx.beginPath();
  ctx.moveTo(x, y);
  canvas.addEventListener('mousemove', trace);
}

function trace(e) {
  if (!tracing) return;
  const x = e.offsetX;
  const y = e.offsetY;
  ctx.lineTo(x, y);
  ctx.stroke();
}

function stopTracing() {
  tracing = false;
  canvas.removeEventListener('mousemove', trace);
  document.getElementById('traceMessage').textContent = "Good job! You traced the shape!";
}

canvas.addEventListener('mousedown', startTracing);
canvas.addEventListener('mouseup', stopTracing);

// Initially, draw the triangle
drawTriangle();
