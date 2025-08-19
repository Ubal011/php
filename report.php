<?php
// report.php - Issue Reporting Page
$activePage = 'report';
$pageTitle = 'Ballot BUZZ - Report Issue';

// Include common headers
require_once __DIR__ . '/header.php';
?>

<!-- CSS specific to this page -->
<style>
/* Main layout */
* { box-sizing: border-box; }
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f5f5f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1;
    display: flex;
    padding: 2rem;
    gap: 2rem;
}

/* Panel styling */
.left-panel {
    flex: 1;
    background: #cfd8e6;
    padding: 1.5rem;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    min-width: 320px;
}
.left-panel h2 {
    margin: 0 0 1rem 0;
    color: #012055;
}

.right-panel {
    flex: 1.2;
    background: #cfd8e6;
    padding: 1.5rem;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
}
.right-panel h2 {
    color: #012055;
    margin-bottom: 0.8rem;
}

/* Form elements */
.tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.tab {
    flex: 1;
    padding: 0.7rem;
    background: white;
    text-align: center;
    font-weight: bold;
    color: #012055;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 0 4px rgba(0,0,0,0.1);
    user-select: none;
}

.tab.active {
    background: #012055;
    color: white;
}

.time-container {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
label {
    font-weight: bold;
    color: #0a2e5c;
}
input[type="text"],
select,
input[type="time"] {
    padding: 0.5rem;
    border-radius: 5px;
    border: 1px solid #999;
    width: 100%;
}

textarea {
    flex: 1;
    padding: 1rem;
    border-radius: 5px;
    border: 1px solid #999;
    resize: vertical;
    min-height: 200px;
    font-size: 1rem;
    font-family: inherit;
}

/* Report list styling */
.reports-list {
    background: white;
    padding: 1rem;
    border-radius: 6px;
    flex: 1;
    overflow-y: auto;
    box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
}

.report-item {
    border-bottom: 1px solid #ddd;
    padding: 0.5rem 0;
}
.report-item:last-child { border-bottom: none; }

/* Status indicators */
.report-status {
    font-weight: bold;
    font-size: 0.9rem;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    color: white;
    display: inline-block;
    margin-left: 0.5rem;
}
.status-inprogress { background-color: #f0ad4e; }
.status-resolved { background-color: #5cb85c; }
.status-pending { background-color: #d9534f; }

/* Responsive adjustments */
@media (max-width: 768px) {
    main {
        flex-direction: column;
        padding: 1rem;
    }
    
    .left-panel,
    .right-panel {
        min-width: auto;
    }
}

/* Buttons row */
.buttons-row {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 1rem;
    justify-content: flex-start;
}
.buttons-row button {
    flex: 1 1 180px;
}
button {
    background-color: #012055;
    color: white;
    border: none;
    padding: 0.7rem 1.5rem;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}
button:hover {
    background-color: #0141b8;
}
</style>

<main>
    <!-- Left Panel: Report Form and List -->
    <div class="left-panel">
        <h2>Report Issue</h2>

        <div class="tabs">
            <div class="tab active" id="createTab">Create Report</div>
            <div class="tab" id="myReportsTab">My Reports</div>
        </div>

        <form id="reportForm">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Polling station address" required>

            <label for="time">Time of Incident</label>
            <div class="time-container">
                <input type="time" id="time" name="time" required>
                <select id="ampm" name="ampm">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>

            <label for="issueType">Type of Issue</label>
            <select id="issueType" name="issueType" required>
                <option value="">-- Select issue type --</option>
                <option value="machine">Voting Machine Problem</option>
                <option value="crowd">Long Waiting Line</option>
                <option value="ballot">Ballot Confusion</option>
                <option value="other">Other Issue</option>
            </select>
        </form>

        <div class="reports-list" id="myReports">
            <div class="report-item">
                <strong>Voting Machine Malfunction</strong>
                <span class="report-status status-inprogress">In Progress</span>
                <p><small>Reported at: Barangay 123, 10:30 AM</small></p>
            </div>
            <div class="report-item">
                <strong>Long Waiting Time</strong>
                <span class="report-status status-resolved">Resolved</span>
                <p><small>Reported at: City Hall, 9:15 AM</small></p>
            </div>
        </div>
    </div>

    <!-- Right Panel: Description and Actions -->
    <div class="right-panel">
        <h2>Description</h2>
        <textarea id="description" placeholder="Describe the issue in detail... What happened? Who was involved? Any witnesses?" required></textarea>
        
        <div class="buttons-row">
            <button type="button" id="photoBtn">Submit Photo</button>
            <button type="button" id="sendBtn">Send</button>
        </div>
    </div>
</main>

<script>
// Tab Navigation
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Toggle visibility of sections
        document.getElementById('reportForm').style.display = 
            this.id === 'createTab' ? 'flex' : 'none';
        document.getElementById('myReports').style.display = 
            this.id === 'myReportsTab' ? 'block' : 'none';
    });
});

// Form Handling
document.getElementById('sendBtn').addEventListener('click', async function() {
    alert('Report sent! (Functionality not implemented)');
});

// Photo Upload (placeholder)
document.getElementById('photoBtn').addEventListener('click', function() {
    alert('Photo upload feature coming soon!');
});
</script>

<?php
// Include common footer
require_once __DIR__ . '/footer.php';
?>
