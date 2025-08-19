<?php
$pageTitle = 'Ballot Buzz - Candidates';
$activePage = 'candidates';
$pageStyles = <<<CSS
body { 
  font-family: Arial, sans-serif; 
  background-color: #f5f5f5; 
  margin: 0; 
  display: flex; 
  flex-direction: column; 
  min-height: 100vh; 
}
nav a.active { 
  background-color: white; 
  color: #0a2e5c; 
  padding: 0.3rem 0.6rem; 
  border-radius: 5px; 
}
main { 
  flex: 1; 
  padding: 2rem; 
  max-width: 1200px; 
  margin: 0 auto; 
  text-align: center; 
}
h1 { 
  color: #012055; 
  margin-bottom: 2rem; 
}
.search-container { 
  margin-bottom: 2rem; 
}
#search-input { 
  width: 100%; 
  max-width: 400px; 
  padding: 0.5rem 1rem; 
  font-size: 1rem; 
  border: 2px solid #012055; 
  border-radius: 25px; 
  outline: none; 
  transition: border-color 0.3s; 
  box-sizing: border-box; 
}
#search-input:focus { 
  border-color: #d9534f; 
}
.candidates-row { 
  display: flex; 
  justify-content: center; 
  gap: 2rem; 
  flex-wrap: wrap; 
}
.candidate-card { 
  background-color: #cfd8e6; 
  border-radius: 8px; 
  padding: 1rem; 
  box-shadow: 0 2px 6px rgba(0,0,0,0.1); 
  width: 300px; 
  display: flex; 
  flex-direction: column; 
  align-items: center; 
  text-align: center; 
  box-sizing: border-box; 
  min-height: 380px; 
  transition: transform 0.2s ease; 
  cursor: pointer; 
}
.candidate-card:hover { 
  transform: translateY(-5px); 
  box-shadow: 0 6px 12px rgba(0,0,0,0.15); 
}
.candidate-photo { 
  width: 120px; 
  height: 120px; 
  border-radius: 50%; 
  border: 4px solid #012055; 
  object-fit: cover; 
  margin-bottom: 1rem; 
  background-color: white; 
  flex-shrink: 0; 
}
.candidate-name { 
  font-size: 1.3rem; 
  font-weight: bold; 
  color: #012055; 
  margin-bottom: 0.3rem; 
}
.candidate-education { 
  font-size: 0.9rem; 
  font-style: italic; 
  margin-bottom: 0.7rem; 
  color: #333; 
}
.candidate-platform { 
  font-size: 1rem; 
  color: #0a2e5c; 
  flex-grow: 1; 
}
CSS;

include __DIR__ . '/header.php';
?>

<main>
  <h1>Candidates</h1>
  <div class="search-container">
    <input type="text" id="search-input" placeholder="Search candidates by name or platform..." oninput="filterCandidates()" />
  </div>
  <div class="candidates-row" id="candidates-row">
    <div class="candidate-card">
      <img src="images/candidate1.jpg" alt="Jane Doe" class="candidate-photo" />
      <div class="candidate-name">Jane Doe</div>
      <div class="candidate-education">B.A. Political Science</div>
      <div class="candidate-platform">Focus on education reform and climate change policies.</div>
    </div>
    <div class="candidate-card">
      <img src="images/candidate2.jpg" alt="John Smith" class="candidate-photo" />
      <div class="candidate-name">John Smith</div>
      <div class="candidate-education">MBA, Public Administration</div>
      <div class="candidate-platform">Advocates for healthcare accessibility and infrastructure development.</div>
    </div>
    <div class="candidate-card">
      <img src="images/candidate3.jpg" alt="Maria Garcia" class="candidate-photo" />
      <div class="candidate-name">Maria Garcia</div>
      <div class="candidate-education">PhD, Economics</div>
      <div class="candidate-platform">Promotes economic growth and social welfare programs.</div>
    </div>
  </div>
</main>

<script>
function filterCandidates() {
  const input = document.getElementById('search-input').value.toLowerCase();
  const cards = document.querySelectorAll('.candidate-card');
  cards.forEach(card => {
    const name = card.querySelector('.candidate-name').textContent.toLowerCase();
    const platform = card.querySelector('.candidate-platform').textContent.toLowerCase();
    card.style.display = (name.includes(input) || platform.includes(input)) ? '' : 'none';
  });
}
</script>

<?php include __DIR__ . '/footer.php'; ?>