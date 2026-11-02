// 1. Sidebar Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

function toggleSidebar() {
    sidebar.classList.toggle('active');
    sidebarOverlay.classList.toggle('active');
}

mobileMenuBtn.addEventListener('click', toggleSidebar);
sidebarOverlay.addEventListener('click', toggleSidebar);

// 2. Profile Dropdown Toggle
const userProfileBtn = document.getElementById('userProfileBtn');
const profileDropdown = document.getElementById('profileDropdown');

userProfileBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // Prevent document click from closing it immediately
    profileDropdown.classList.toggle('show');
});

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
    if (!userProfileBtn.contains(e.target)) {
        profileDropdown.classList.remove('show');
    }
});

// 3. Chart.js Configurations
// Income vs Expenses Chart
const ctx1 = document.getElementById('incomeExpenseChart').getContext('2d');
new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        datasets: [
            {
                label: 'Income',
                data: [20, 22, 25, 28, 27, 26, 30, 30, 31, 38],
                backgroundColor: '#10b981',
                borderRadius: 4,
                barPercentage: 0.6,
                categoryPercentage: 0.5
            },
            {
                label: 'Expenses',
                data: [18, 20, 18, 22, 24, 22, 24, 26, 25, 30],
                backgroundColor: '#3b82f6',
                borderRadius: 4,
                barPercentage: 0.6,
                categoryPercentage: 0.5
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        resizeDelay: 200, // রিসাইজ লুপ বন্ধ করতে সাহায্য করে
        plugins: {
            legend: {
                position: 'top',
                align: 'end',
                labels: {
                    usePointStyle: true,
                    boxWidth: 8
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 40,
                ticks: {
                    callback: function(value) { return value + 'L'; }
                },
                grid: { drawBorder: false, color: '#f3f4f6' }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

// Expense Breakdown Doughnut Chart
const ctx2 = document.getElementById('expenseChart').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Salaries', 'Rent & Office', 'Utilities', 'Marketing', 'Travel', 'Others'],
        datasets: [{
            data: [32, 18, 12, 10, 8, 20],
            backgroundColor: [
                '#3b82f6', // Salaries (Blue)
                '#f97316', // Rent (Orange)
                '#10b981', // Utilities (Green)
                '#8b5cf6', // Marketing (Purple)
                '#ec4899', // Travel (Pink)
                '#6b7280'  // Others (Gray)
            ],
            borderWidth: 0,
            cutout: '75%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false // We'll build a custom legend if needed, or hide for simplicity
            }
        }
    }
});   

function loadPage(pageName) {  
    if(pageName === 'add-transaction') {
        window.location.href = "add-transaction.html";
    } else if (pageName === 'transactions') {
        window.location.href = "transactions.html"; 
    }
}

const addForm = document.getElementById('addTransactionForm');
if (addForm) {
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const type = document.getElementById('trxType').value;
        const amount = document.getElementById('trxAmount').value;
        const desc = document.getElementById('trxDesc').value;
        
        if(type && amount && desc) {
            alert(`Transaction Saved Successfully!\n\nType: ${type}\nAmount: ৳${amount}\nDescription: ${desc}`);
            addForm.reset(); 
        } else {
            alert("Please fill in all required fields.");
        }
    });
}