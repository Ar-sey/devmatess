const canvas = document.getElementById("shapeCanvas");
const ctx = canvas.getContext("2d");
const feedback = document.getElementById("feedback");

let currentShapeIndex = 0;
let drawing = false;
let userPath = [];
let currentPath;

const tolerance = 0.3; // Only 30% of user points must match

// Shape drawing functions
const shapeDrawers = {
  star(ctx) {
    const cx = 200, cy = 200, spikes = 5, outerRadius = 80, innerRadius = 35;
    let rot = Math.PI / 2 * 3;
    let step = Math.PI / spikes;
    const path = new Path2D();

    path.moveTo(cx, cy - outerRadius);
    for (let i = 0; i < spikes; i++) {
      let x = cx + Math.cos(rot) * outerRadius;
      let y = cy + Math.sin(rot) * outerRadius;
      path.lineTo(x, y);
      rot += step;

      x = cx + Math.cos(rot) * innerRadius;
      y = cy + Math.sin(rot) * innerRadius;
      path.lineTo(x, y);
      rot += step;
    }
    path.closePath();
    ctx.stroke(path);
    return path;
  },

  triangle(ctx) {
    const path = new Path2D();
    path.moveTo(200, 100);
    path.lineTo(300, 300);
    path.lineTo(100, 300);
    path.closePath();
    ctx.stroke(path);
    return path;
  },

  diamond(ctx) {
    const path = new Path2D();
    path.moveTo(200, 80);
    path.lineTo(300, 200);
    path.lineTo(200, 320);
    path.lineTo(100, 200);
    path.closePath();
    ctx.stroke(path);
    return path;
  },

  rectangle(ctx) {
    const path = new Path2D();
    path.rect(100, 100, 200, 150);
    ctx.stroke(path);
    return path;
  },

  square(ctx) {
    const path = new Path2D();
    path.rect(120, 120, 160, 160);
    ctx.stroke(path);
    return path;
  }
};

// Draw shape
function drawShape(shapeName) {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.lineWidth = 3;
  ctx.strokeStyle = "#000";
  userPath = [];
  currentPath = shapeDrawers[shapeName](ctx);
}

// More forgiving accuracy check
function isTracingCorrect() {
  let matchCount = 0;

  for (const point of userPath) {
    // Try checking within a 10x10 box around each point
    let matched = false;
    for (let dx = -5; dx <= 5; dx += 5) {
      for (let dy = -5; dy <= 5; dy += 5) {
        if (ctx.isPointInStroke(currentPath, point.x + dx, point.y + dy)) {
          matched = true;
          break;
        }
      }
      if (matched) break;
    }

    if (matched) matchCount++;
  }

  return userPath.length > 10 && (matchCount / userPath.length >= tolerance);
}

// Mouse draw logic
canvas.addEventListener("mousedown", () => {
  drawing = true;
  userPath = [];
});

canvas.addEventListener("mouseup", () => {
  drawing = false;

  if (isTracingCorrect()) {
    feedback.textContent = "✅ Great job!";
    setTimeout(() => {
      currentShapeIndex++;
      if (currentShapeIndex < shapeList.length) {
        feedback.textContent = "";
        drawShape(shapeList[currentShapeIndex]);
      } else {
        feedback.textContent = "🎉 All shapes completed!";
      }
    }, 1000);
  } else {
    feedback.textContent = "❌ Try again!";
    setTimeout(() => {
      feedback.textContent = "";
      drawShape(shapeList[currentShapeIndex]); // Retry same shape
    }, 1000);
  }
});

canvas.addEventListener("mousemove", (e) => {
  if (!drawing) return;

  const rect = canvas.getBoundingClientRect();
  const x = e.clientX - rect.left;
  const y = e.clientY - rect.top;

  userPath.push({ x, y });

  ctx.fillStyle = "#f107a3";
  ctx.beginPath();
  ctx.arc(x, y, 2, 0, 2 * Math.PI);
  ctx.fill();
});

// Start game
drawShape(shapeList[currentShapeIndex]);
