// Dark/Light Mode Toggle
function toggleMode() {
    document.body.classList.toggle("dark");
    const icon = document.getElementById("modeToggle");
    icon.textContent = document.body.classList.contains("dark") ? "☀️" : "🌙";
    
    // Save preference
    localStorage.setItem("theme", document.body.classList.contains("dark") ? "dark" : "light");
}

// Load saved theme
document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark");
        document.getElementById("modeToggle").textContent = "☀️";
    }
});