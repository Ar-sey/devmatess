// questions.js - Handle questions and answers

const questions = [
  { question: "Can you find the Triangle?", correct: "triangle", options: ["star", "triangle"] },
  { question: "Point to the square?", correct: "square", options: ["square", "circle"] },
  { question: "Which one is the Rectangle?", correct: "rectangle", options: ["circle", "rectangle"] },
  { question: "Find the Diamond shape.", correct: "diamond", options: ["diamond", "square"] },
  { question: "Can you spot the Star?", correct: "star", options: ["star", "circle"] }
];

let currentIndex = 0;
let score = 0;

const questionText = document.getElementById("questionText");
const shapeContainer = document.getElementById("shapeContainer");
const resultText = document.getElementById("resultText");
const scoreText = document.getElementById("scoreText");
const endButtons = document.getElementById("endButtons");

// Load the question and shapes
function loadQuestion() {
  const question = questions[currentIndex];
  questionText.textContent = question.question;
  resultText.textContent = "";

  shapeContainer.innerHTML = ""; // Clear previous options

  // Loop through the options and create a shape for each option
  question.options.forEach(shape => {
    const div = document.createElement("div");
    div.className = `shape ${shape}`; // Assign the shape class (for CSS styling)
    
    // Set onclick event to check the answer
    div.onclick = () => checkAnswer(shape);
    
    shapeContainer.appendChild(div);
  });
}

// Check if the selected answer is correct
function checkAnswer(selected) {
  const question = questions[currentIndex];

  if (selected === question.correct) {
    resultText.textContent = "✅ Correct!";
    score++;
  } else {
    resultText.textContent = "❌ Wrong!";
  }

  // Update score
  scoreText.textContent = `Score: ${score}`;

  // Move to next question
  setTimeout(() => {
    currentIndex++;
    if (currentIndex < questions.length) {
      loadQuestion();
    } else {
      // End of the quiz
      endQuiz();
    }
  }, 1000);
}

// End the quiz and show the final score
function endQuiz() {
  questionText.style.display = "none";
  shapeContainer.style.display = "none";
  resultText.textContent = `🎯 Final Score: ${score} / ${questions.length}`;
  scoreText.style.display = "none"; // Hide score during the end
  endButtons.style.display = "block"; // Show buttons to go to next activity
}

// Start the quiz
loadQuestion();
